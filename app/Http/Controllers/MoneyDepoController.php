<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepoMoneyTransaction;
use App\Models\Member;
use App\Models\Promo;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MoneyDepoController extends Controller
{
    public function index() {
        $datadepomoney = DepoMoneyTransaction::orderBy('ID_TRANSAKSI_DEPOSIT_UANG','desc')->paginate(10);
        $member = Member::all();

        
        return view('money-deposit/money-deposit_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'datadepomoney' => $datadepomoney, 
            'members' => $member,
        ]);
    }

    public function print_receipt($id){
        $datadepomoney = DepoMoneyTransaction::where('ID_TRANSAKSI_DEPOSIT_UANG',$id)->first();
        return view('money-deposit/money-deposit_receipt')->with([
            'datadepomoney' => $datadepomoney,
        ]);
    }

    public function store_data(Request $request){
        $validate = $request->validate([
            'ID_MEMBER' => ['required'],
            'JUMLAH_DEPOSIT' => ['required','numeric'],
            'JUMLAH_UANG' => ['required']
        ],[
            'ID_MEMBER.required' => 'The member name field is required',
            'JUMLAH_DEPOSIT.required' => 'The nominal field is required',
            'JUMLAH_DEPOSIT.numeric' => 'Format nominal is numeric',
            'JUMLAH_UANG.required' => 'The pay cost field is required'
        ]);

        $member_check = Member::where('ID_MEMBER',$request->ID_MEMBER)->where('MASA_AKTIVASI','!=',null)->where('MASA_AKTIVASi','>=',Carbon::now())->first();

        if(!($member_check)) {
            return redirect()->intended('dashboard/money-deposit')->with(['error' => 'Member not activated. Please activate first']);
        }
        
        if($request->JUMLAH_DEPOSIT >= 3000000 && $request->SISA_DEPOSIT >=500000) {
            $promo = Promo::where('BONUS',300000)->first();
            if($promo) {
                $idPromo = $promo->ID_PROMO;
                $bonus = $promo->BONUS;
            }else {
                $idPromo = null;
                $bonus = 0;
            }
        }else {
            $idPromo = null;
            $bonus = 0;
        }
        
        if($request->SISA_DEPOSIT) {
            $sisa = $request->SISA_DEPOSIT;
        }else {
            $sisa = 0;
        }

        if($request->JUMLAH_UANG < $request->JUMLAH_DEPOSIT){
            return redirect()->back()->with(['error' => 'Your money is less']);
        }
        
        $datadepomoney = DepoMoneyTransaction::create([
            'ID_PROMO' => $idPromo,
            'ID_MEMBER' => $request->ID_MEMBER,
            'ID_PEGAWAI' => Auth::guard('pegawai')->user()->ID_PEGAWAI,
            'JUMLAH_DEPOSIT' => $request->JUMLAH_DEPOSIT,
            'BONUS_DEPOSIT' => $bonus,
            'SISA_DEPOSIT' => $sisa,
            'TOTAL_DEPOSIT' => $request->JUMLAH_DEPOSIT + $sisa + $bonus,
            'TANGGAL_DEPOSIT_UANG' => Carbon::now(),
            'KEMBALIAN' => $request->JUMLAH_UANG - $request->JUMLAH_DEPOSIT
        ]);

        if($datadepomoney){
            $member = Member::where('ID_MEMBER',$request->ID_MEMBER)->first();
            $member->SISA_DEPOSIT_MEMBER = $request->JUMLAH_DEPOSIT + $sisa + $bonus;
            $member->update();
            $data = DepoMoneyTransaction::latest('ID_TRANSAKSI_DEPOSIT_UANG')->first();
            return redirect()->intended('dashboard/money-deposit-receipt/'.$data->ID_TRANSAKSI_DEPOSIT_UANG);
        }else {
            return redirect()->intended('dashboard/money-deposit')->with(['error' => 'Failed deposit member']);
        }
    }

    public function index_confirm_depomoney(Request $request){
        $this->validate($request,[
            'ID_MEMBER' => 'required',
            'JUMLAH_DEPOSIT' => ['required','numeric'],
        ],[
            'ID_MEMBER.required' => 'The member field is required',
            'JUMLAH_DEPOSIT.required' => 'The nominal field is required',
            'JUMLAH_DEPOSIT.numeric' => 'Format nominal is numeric'
        ]);

        $member = Member::where('ID_MEMBER',$request->ID_MEMBER)->first();
        
        return view('money-deposit/confirmation-pay-money')->with([
            'user' => Auth::guard('pegawai')->user(),
            'member' => $member,
            'jumlah_deposit' => $request->JUMLAH_DEPOSIT
        ]);
    }

}