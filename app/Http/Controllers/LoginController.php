<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PegawaiResource;
use App\Models\Pegawai;
use App\Models\Member;
use App\Models\Instructor;
use Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index() {
        if($pegawai = Auth::guard('pegawai')->user()) {
            return redirect()->intended('dashboard/main');
        }
        return view('login');
    }

    public function login(Request $request) {
        if($request->accepts('text/html')) {
            $validate = $request->validate([
                'EMAIL_PEGAWAI' => ['required','email:rfc,dns'],
                'password' => ['required'],
            ],[
                'EMAIL_PEGAWAI.required' => 'The email employee field is required',
                'EMAIL_PEGAWAI.email' => 'Email using format @',
                'password' => 'The password employee field is required',
            ]);

            $credential = $request->only('EMAIL_PEGAWAI','password');

            if(Auth::guard('pegawai')->attempt($credential)) {
                $request->session()->regenerate();
                $user = Auth::guard('pegawai')->user();
                if ($user) {
                    return redirect()->intended('dashboard/main');
                }
            }
            return redirect()->intended('/')->with('error','Invalid Credential');
        }else if($request->expectsJson()) {
            $data = $request->only('Email','password');
            $credentials = Validator::make($data, [
                'Email' => ['required','email:rfc,dns'],
                'password' => ['required'],
            ],[
                'Email.required' => 'The email field is required',
                'Email.email' => 'Email using format @',
                'password' => 'The password field is required',
            ]);

            if($credentials->fails()) {
                return response(['success' => false,'message' => $credentials->errors()],400);   
            }
            
            $pegawai_exists = Pegawai::where('EMAIL_PEGAWAI',$request->Email)->where('ROLE_PEGAWAI','Manajer Operasional')->first();
            $member_exists = Member::where('EMAIL_MEMBER',$request->Email)->first();
            $instructor_exists = Instructor::where('EMAIL_INSTRUKTUR',$request->Email)->first();

            if($pegawai_exists && Hash::check($request->password,$pegawai_exists->password)) {
                if(Auth::guard('pegawai')->attempt(['EMAIL_PEGAWAI' => $request->Email,'password' => $request->password])) {
                    $pegawai =Auth::guard('pegawai')->user();
                    $token = $pegawai->createToken('Authentication Token')->accessToken;
                    return response([
                        'message' => 'Authenticated',
                        'user' => $pegawai,
                        'token_type' => 'Bearer',
                        'access_token' => $token
                    ],200);
                }
                return response([
                    'message' => 'Invalid Credentials',
                    'user' => null,
                ], 400);

            }else if($member_exists && Hash::check($request->password,$member_exists->password)) {
                if(Auth::guard('member')->attempt(['EMAIL_MEMBER' => $request->Email,'password' => $request->password])) {
                    $member = Auth::guard('member')->user();
                    $token = $member->createToken('Authentication Token')->accessToken;
                    return response([
                        'message' => 'Authenticated',
                        'user' => $member,
                        'token_type' => 'Bearer',
                        'access_token' => $token
                    ],200);
                }
                return response([
                    'message' => 'Invalid Credentials',
                    'user' => null,
                ], 400);

            }else if($instructor_exists && Hash::check($request->password,$instructor_exists->password)) {
                if(Auth::guard('instructor')->attempt(['EMAIL_INSTRUKTUR' => $request->Email,'password' => $request->password])) {
                    $instructor = Auth::guard('instructor')->user();
                    $token = $instructor->createToken('Authentication Token')->accessToken;
                    return response([
                        'message' => 'Authenticated',
                        'user' => $instructor,
                        'token_type' => 'Bearer',
                        'access_token' => $token
                    ],200);
                }
                return response([
                    'message' => 'Invalid Credentials',
                    'user' => null,
                ], 400);
            }else {
                return response([
                    'message' => 'Invalid Credentials',
                    'user' => null,
                ], 400);
            }
        }
    }


    public function logout(Request $request){
        if($request->accepts('text/html')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect('/')->with('success','You have successfully logged out');
        }else {
            $user = Auth::user()->token();
            $user->revoke();

            return response()->json([
                'message' => 'Logout Success',
                'user' => $user
            ], 200);
        }
    }

    public function search(){
        return view('search_email')->with([
            'pegawai' => null,
        ]);
    }

    public function search_email(Request $request){
        $validate = $request->validate([
            'EMAIL_PEGAWAI' => ['required','email:rfc,dns'],
        ],[
            'EMAIL_PEGAWAI.required' => 'The email pegawai field is required',
            'EMAIL_PEGAWAI.email' => 'Email using format @',
        ]);

        $pegawai = Pegawai::where('EMAIL_PEGAWAI',$request->EMAIL_PEGAWAI)->first();
        
        if($pegawai) {
            return redirect()->intended('search')->with([
                'success' => 'Sucessfully search email',
                'pegawai' => $pegawai
            ]);
        }else {
            return redirect()->intended('search')->with([
                'error' => 'Email not found',
                'pegawai' => null
            ]);
        }
    }

    public function change_password(Request $request, $id) {

        if($request->accepts('text/html')) {
            $validate = Validator::make($request->all(),[
                'password' => ['required'],
                'repassword' => ['required'],
            ],[
                'password.required' => 'The password field is required',
                'repassword.required' => 'The re-password field is required'
            ]);
    
            $pegawai = Pegawai::where('ID_PEGAWAi',$id)->first();
    
            if($validate->fails()) {
                return redirect()->intended('search')->withErrors($validate)->with([
                    'pegawai' => $pegawai
                ]);
            }
            if($pegawai) {
                if($request->password == $request->repassword){
                    $pegawai->password = \bcrypt($request->password);
                    $pegawai->update();
                    return redirect()->intended('/')->with([
                        'success' => 'Succesfully change password'
                    ]);
                }else {
                    return redirect()->intended('search')->with([
                        'error' => 'Confirm new password wrong',
                        'pegawai' => $pegawai
                    ]);
                }
            }else {
                return redirect()->intended('search')->with([
                    'error' => 'Employee not found',
                    'pegawai' => null
                ]);
            }
        } 
    }

    //API BACKEND

    public function change_password_api(Request $request){
        $data = $request->only('Email','password');
        $credentials = Validator::make($data, [
            'Email' => ['required','email:rfc,dns'],
            'password' => ['required'],
        ],[
            'Email.required' => 'The email field is required',
            'Email.email' => 'Email using format @',
            'password' => 'The password field is required',
        ]);

        if($credentials->fails()) {
            return response(['success' => false,'message' => $credentials->errors()],400);   
        }
        $pegawai_exists = Pegawai::where('EMAIL_PEGAWAI',$request->Email)->where('ROLE_PEGAWAI','Manajer Operasional')->first();
        $member_exists = Member::where('EMAIL_MEMBER',$request->Email)->first();
        $instructor_exists = Instructor::where('EMAIL_INSTRUKTUR',$request->Email)->first();
        
        if($member_exists) {
            return response([
                'message' => 'Member cant change password. Please contact cashier',
                'user' => null,
            ],400);
        }else if($pegawai_exists) {
            $pegawai_exists->password = \bcrypt($request->password);
            $pegawai_exists->update();
            return response([
                'message' => 'Succesfully update password employee',
                'user' => $pegawai_exists,
            ],200);
        }else if($instructor_exists) {
            $instructor_exists->password = \bcrypt($request->password);
            $instructor_exists->update();
            return response([
                'message' => 'Succesfully update password instructor',
                'user' => $instructor_exists,
            ],200);
        }
        return response([
            'message' => 'user not found',
            'user' => null,
        ], 400);
    }
}