<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivationTrasaction;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ActivationTransactionController extends Controller
{
    public function index() {
        $TA = ActivationTrasaction::orderBy('ID_TRANSAKSI_AKTIVASI','desc')->paginate(10);
        $member = Member::Where('MASA_AKTIVASI',null)->get();
        
        return view('activation-transaction/activation-transaction_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'dataActivation' => $TA, 
            'members' => $member,
        ]);
    }

    public function print_receipt($id){
        $TA = ActivationTrasaction::where('ID_TRANSAKSI_AKTIVASI',$id)->first();
        return view('activation-transaction/activation-transaction_receipt')->with([
            'dataActivation' => $TA,
        ]);
    }

    public function create(Request $request) {

        $this->validate($request,[
            'ID_MEMBER' => 'required',
            'JUMLAH_UANG' => 'required',
        ],[
            'ID_MEMBER.required' => 'The member field is required',
            'JUMLAH_UANG.required' => 'The pay cost field is required'
        ]);
        
        $member = Member::where('ID_MEMBER',$request->ID_MEMBER)->first();
        $pegawai = Auth::guard('pegawai')->user();

        if($request->JUMLAH_UANG < 3000000){
            return redirect()->back()->with(['error' => 'Your money is less']);
        }
        
        if($member) {
            $activation_transaction = ActivationTrasaction::create([
                'ID_MEMBER' => $member->ID_MEMBER,
                'ID_PEGAWAI' => $pegawai->ID_PEGAWAI,
                'TANGGAL_TRANSAKSI_AKTIVASI' => Carbon::now()->format('Y-m-d H:i:s'),
                'TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI' => Carbon::now()->addYears(1)->format('Y-m-d H:i:s'),
                'BIAYA_AKTIVASI' => 3000000,
                'STATUS' => "Paid",
                'KEMBALIAN' => $request->JUMLAH_UANG - 3000000
            ]);
            
            if($activation_transaction) {
                 // generate masa aktif member di table member
                $member->MASA_AKTIVASI = Carbon::now()->addYears(1)->format('Y-m-d H:i:s');
                $member->update();
                $data = ActivationTrasaction::latest('ID_TRANSAKSI_AKTIVASI')->first();
                return redirect()->intended('dashboard/activation-transaction-receipt/'.$data->ID_TRANSAKSI_AKTIVASI);
            }else {
                return redirect()->intended('dashboard/activation-transaction')->with(['error' => 'Failed activate member']);
            }
        }else {
            return redirect()->intended('dashboard/activation-transaction')->with(['error' => 'Failed activate member']);
        }
    }

    public function index_confirm_activation(Request $request){
        $this->validate($request,[
            'ID_MEMBER' => 'required'
        ],[
            'ID_MEMBER.required' => 'The member field is required'
        ]);

        $member = Member::where('ID_MEMBER',$request->ID_MEMBER)->first();
        
        return view('activation-transaction/confirmation-pay-activation')->with([
            'user' => Auth::guard('pegawai')->user(),
            'member' => $member,
        ]);
    }
}