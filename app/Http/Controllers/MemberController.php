<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberDepositClass;
use App\Models\DepoClassTransacton;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class MemberController extends Controller
{
    public function index() {
        $member = Member::orderby('ID_MEMBER','desc')->paginate(5);
        
        return view('member/member_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'members' => $member,
        ]);
    }

    public function create() {
        return view('member/member_create')->with([
            'user' => Auth::guard('pegawai')->user(),
        ]);
    }

    public function search(Request $request) {
            $member = Member::where('NAMA_MEMBER', 'like','%'.$request->keyword.'%')
            ->orWhere('EMAIL_MEMBER', 'like','%'.$request->keyword.'%')
            ->orWhere('USIA_MEMBER', 'like','%'.$request->keyword.'%')
            ->orWhere('ALAMAT_MEMBER', 'like','%'.$request->keyword.'%')
            ->orWhere('TANGGAL_LAHIR_MEMBER', 'like','%'.$request->keyword.'%')
            ->orWhere('TELEPON_MEMBER', 'like','%'.$request->keyword.'%')
            ->orWhere('JENIS_KELAMIN_MEMBER', 'like','%'.$request->keyword.'%')
            ->orWhere('MASA_AKTIVASI', 'like','%'.$request->keyword.'%')
            ->orWhere('SISA_DEPOSIT_MEMBER', 'like','%'.$request->keyword.'%')
            ->orWhere('ID_MEMBER', 'like','%'.$request->keyword.'%')
            ->paginate(5);
            $member->appends(['keyword' => $request->keyword]);
        // if($request->keyword != null) {
            
        // }
        // else {
        //     $member = Member::orderby('ID_MEMBER','desc')->paginate(5);
        // }
        
        return view('member/member_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'members' => $member,
        ]);
    }

    public function cetak_card($id) {
        $member = Member::where('ID_MEMBER',$id)->first();
        return view('member/member_card')->with([
            'member' => $member,
        ]);
        // return view('member/member_card');
    }

    public function edit($id){
        $member = Member::where('ID_MEMBER',$id)->first();

        return view('member/member_edit')->with([
            'user' => Auth::guard('pegawai')->user(),
            'member' => $member,
        ]);
    }

    public function store(Request $request) {

        Session::flash('NAMA_MEMBER',$request->NAMA_MEMBER);
        Session::flash('ALAMAT_MEMBER',$request->ALAMAT_MEMBER);
        // Session::flash('TANGGAL_LAHIR_MEMBER',$request->TANGGAL_LAHIR_MEMBER);
        Session::flash('TELEPON_MEMBER',$request->TELEPON_MEMBER);
        Session::flash('USIA_MEMBER',$request->USIA_MEMBER);
        Session::flash('JENIS_KELAMIN_MEMBER',$request->JENIS_KELAMIN_MEMBER);
        Session::flash('EMAIL_MEMBER',$request->EMAIL_MEMBER);
        Session::flash('password',$request->password);

        $validate = $request->validate([
            'NAMA_MEMBER' => ['required'],
            'ALAMAT_MEMBER'=> ['required'],
            'TANGGAL_LAHIR_MEMBER'=> ['required','date_format:Y-m-d'],
            'TELEPON_MEMBER' => ['required','numeric'],
            'USIA_MEMBER' => ['required','numeric'],
            'JENIS_KELAMIN_MEMBER'=> ['required'],
            // 'MASA_AKTIVASI' => ['required'],
            // 'SISA_DEPOSIT_MEMBER'=> ['required'],
            // 'SISA_DEPOSIT_KELAS' => ['required'],
            'EMAIL_MEMBER' => ['required', 'email:rfc,dns','unique:member'],
            'password' => ['required'],
        ],[
            'NAMA_MEMBER.required' => 'The name field is required',
            'ALAMAT_MEMBER.required' => 'The address field is required',
            'TANGGAL_LAHIR_MEMBER.required' => 'The date of birth field is required',
            'TANGGAL_LAHIR_MEMBER.date_format' => 'The date of birth field not formated yyyy-mm-dd',
            'TELEPON_MEMBER.required' => 'The call number field is required',
            'TELEPON_MEMBER.numeric' => 'Format call number using numeric ',
            'USIA_MEMBER.required' => 'The age field is required',
            'USIA_MEMBER.numeric' => 'Format age using numeric',
            'JENIS_KELAMIN_MEMBER.required' => 'The gender field is required',
            // 'MASA_AKTIVASI',
            // 'SISA_DEPOSIT_MEMBER',
            // 'SISA_DEPOSIT_KELAS',
            'EMAIL_MEMBER.required' => 'The email field is required',
            'EMAIL_MEMBER.email' => 'Format email using @',
            'EMAIL_MEMBER.unique' => 'Email has already been taken',
            'password.required' => 'The password field is required',
        ]);

        $datamember = $request->all();

        $datamember['password'] = \bcrypt($request->password);
        $datamember['MASA_AKTIVASI'] = null;
        $datamember['SISA_DEPOSIT_MEMBER'] = 0;
        $datamember['SISA_DEPOSIT_KELAS'] = 0;

        $member = Member::create($datamember);

        if($member) {
            return redirect()->intended('dashboard/member')->with(['success' => 'Successfully added member']);
        }
        return redirect()->intended('dashboard/create-member')->with(['error' => 'Failed added member']);
    }

    public function update(Request $request, $id) {
        $member = Member::where('ID_MEMBER',$id)->first();

        if($request->NAMA_MEMBER) {
            $member->NAMA_MEMBER = $request->NAMA_MEMBER;
        }
        if($request->ALAMAT_MEMBER){
            $member->ALAMAT_MEMBER = $request->ALAMAT_MEMBER;
        }
        if($request->TANGGAL_LAHIR_MEMBER){
            $member->TANGGAL_LAHIR_MEMBER = $request->TANGGAL_LAHIR_MEMBER;
        }
        if($request->TELEPON_MEMBER){
            $member->TELEPON_MEMBER = $request->TELEPON_MEMBER;
        }
        if($request->USIA_MEMBER){
            $member->USIA_MEMBER = $request->USIA_MEMBER;
        }
        if($request->JENIS_KELAMIN_MEMBER){
            $member->JENIS_KELAMIN_MEMBER = $request->JENIS_KELAMIN_MEMBER;
        }
        if($request->EMAIL_MEMBER){
            $member->EMAIL_MEMBER = $request->EMAIL_MEMBER;
        }
        if($request->password){
            $member->password = \bcrypt ($request->password);
        }
        
        $member_update = Member::where('ID_MEMBER', $id) 
        ->update(array('NAMA_MEMBER' => $member->NAMA_MEMBER, 
        'ALAMAT_MEMBER' => $member->ALAMAT_MEMBER,
        'TANGGAL_LAHIR_MEMBER' => $member->TANGGAL_LAHIR_MEMBER,
        'TELEPON_MEMBER' => $member->TELEPON_MEMBER,
        'USIA_MEMBER' => $member->USIA_MEMBER,
        'JENIS_KELAMIN_MEMBER'=> $member->JENIS_KELAMIN_MEMBER,
        'EMAIL_MEMBER' => $member->EMAIL_MEMBER,
        'password' => $member->password),
    ); 

        if($member_update) {
            return redirect()->intended('dashboard/member')->with(['success' => 'Successfully update member']);
        }
        return redirect()->intended('dashboard/edit-member/'.$id)->with(['error' => 'Failed update member']);


    }

    public function reset_password($id){
        $member = Member::where('ID_MEMBER',$id)->first();

        $member_update = Member::where('ID_MEMBER', $id)
        ->update(array('password' => bcrypt($member->TANGGAL_LAHIR_MEMBER))); 

        if($member_update) {
            return redirect()->intended('dashboard/member')->with([
                'success' => 'Member has been successfully reset password using DOB Member (yyyy-mm-dd)'
            ]);
        }else {
            return redirect()->intended('dashboard/member')->with([
                'success' => 'Member not reset password successfully'
            ]);
        }
    }

    public function destroy($id) {
        $member = Member::find($id);

        try {
            if($member) {
                $member->delete();
                return redirect()->intended('dashboard/member')->with([
                    'success' => 'Member has been successfully deleted'
                ]);
            }else {
                return redirect()->intended('dashboard/member')->with([
                    'error' => 'Member not deleted successfully'
                ]);
            }
        } catch ( \Exception $e) {
            //   var_dump($e->errorInfo );
            return redirect()->back()->with('error', "Data cant be delete because use on another data master");
        }
        
    }

    public function index_deactive(){
        $member = Member::orderby('ID_MEMBER','desc')->where('MASA_AKTIVASI','<',Carbon::now())->paginate(5);
        $member_after = Member::orderby('ID_MEMBER','desc')->where('MASA_AKTIVASI',null)->paginate(5);
        
        return view('member/member-deactive_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'members' => $member,
            'members_after' => $member_after
        ]);
    }

    public function deactive(){
        $members = Member::orderby('ID_MEMBER','desc')->where('MASA_AKTIVASI','<',Carbon::now())->get();
        if($members){
            foreach($members as $member) {
                if($member->expired_deactive < Carbon::now() || $member->expired_deactive == null ){
                    $member->MASA_AKTIVASI = null;
                    $member->SISA_DEPOSIT_MEMBER = 0;
                    $member->expired_deactive = Carbon::now()->addDays(1);
                    $member->update();
                }else {
                    return redirect()->intended('dashboard/deactive-member')->with(['error' => 'Failed deactive member id '.$member->ID_MEMBER.' because you can deactive this member tomorrow']);
                }
            } 
            return redirect()->intended('dashboard/deactive-member')->with(['success' => 'Sucessfully deactive member. If you want activate member again, please go to menu Manage Activation']);
        }
        return redirect()->intended('dashboard/deactive-member')->with(['error' => 'Member not found']);
    }

    public function reset_class_index(){
        $member = MemberDepositClass::orderby('ID_DEPOSIT','desc')->where('MASA_BERLAKU','<',Carbon::now())->paginate(5);
        $member_after = MemberDepositClass::orderby('ID_DEPOSIT','desc')->where('MASA_BERLAKU',null)->orWhere('MASA_BERLAKU','>',Carbon::now())->paginate(5);
        
        return view('member/member-reset-class_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'members' => $member,
            'members_after' => $member_after
        ]);
    }

    public function reset_class(){
        $members = MemberDepositClass::orderby('ID_DEPOSIT','desc')->where('MASA_BERLAKU','<',Carbon::now())->get();
        if($members){
            foreach($members as $member){
                if($member->expired_reset_class < Carbon::now() || $member && $member->expired_reset_class == null ){
                    $member->DEPO_SISA = 0;
                    $member->MASA_BERLAKU = null;
                    $member->expired_reset_class = Carbon::now()->addDays(1);
                    $member->update();
                }else {
                    return redirect()->intended('dashboard/reset-class-member')->with(['error' => 'Failed reset class member '.$member->member->NAMA_MEMBER.' class '.$member->kelas->NAMA_KELAS.' because you can deactive this member tomorrow']);
                }
            }
            return redirect()->intended('dashboard/reset-class-member')->with(['success' => 'Sucessfully reset class packet']);
        }
        return redirect()->intended('dashboard/reset-class-member')->with(['error' => 'Member not found']);
    }

    public function member_profile(Request $request,$id){
        if($request->expectsJson()){
            $member = DB::select('SELECT m.ID_MEMBER, m.NAMA_MEMBER, m.MASA_AKTIVASI, m.SISA_DEPOSIT_MEMBER, k.NAMA_KELAS, md.DEPO_SISA, md.MASA_BERLAKU 
            FROM member m 
            LEFT JOIN member_deposit_kelas md ON m.ID_MEMBER = md.ID_MEMBER 
            LEFT JOIN kelas k ON k.ID_KELAS = md.ID_KELAS
            WHERE m.ID_MEMBER = "'.$id.'"GROUP BY k.NAMA_KELAS');

            // if(!$member){
            //     $member = DB::select('SELECT m.ID_MEMBER, m.NAMA_MEMBER, m.MASA_AKTIVASI, m.SISA_DEPOSIT_MEMBER
            //     FROM member m 
            //     WHERE m.ID_MEMBER = "'.$id.'"');
            // }

            return response([
                'message' => 'success get data member',
                'data' => $member
            ],200);
        }
    }
}