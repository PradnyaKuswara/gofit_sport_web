<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;
use Carbon\Carbon;

class InstructorController extends Controller
{
    public function index() {
        $instructor = Instructor::orderby('ID_INSTRUKTUR','desc')->paginate(5);

        return view('instructor/instructor_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'instructors' => $instructor,
        ]);
    }

    public function create() {
        return view('instructor/instructor_create')->with([
            'user' => Auth::guard('pegawai')->user(),
        ]);
    }

    public function search(Request $request) {
        $instructor = Instructor::where('NAMA_INSTRUKTUR', 'like' , '%'.$request->keyword.'%')
        ->orWhere('ALAMAT_INSTRUKTUR', 'like' , '%'.$request->keyword.'%')
        ->orWhere('TELEPON_INSTRUKTUR', 'like' , '%'.$request->keyword.'%')
        ->orWhere('UMUR_INSTRUKTUR', 'like' , '%'.$request->keyword.'%')
        ->orWhere('JENIS_KELAMIN_INSTRUKTUR', 'like' , '%'.$request->keyword.'%')
        ->orWhere('TANGGAL_LAHIR_INSTRUKTUR', 'like' , '%'.$request->keyword.'%')
        ->orWhere('EMAIL_INSTRUKTUR', 'like' , '%'.$request->keyword.'%')
        ->orWhere('JUMLAH_TERLAMBAT', 'like' , '%'.$request->keyword.'%')
        ->orWhere('ID_INSTRUKTUR', 'like' , '%'.$request->keyword.'%')
        ->paginate(5);
        $instructor->appends(['keyword' => $request->keyword]);
        // if($request->keyword != null) {
           
        // }
        // else {
        //     $instructor = Instructor::orderby('ID_INSTRUKTUR','desc')->paginate(5);
        //     // $instructor->appends(['keyword' => $request->keyword]);
        // }
        
        return view('instructor/instructor_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'instructors' => $instructor,
        ]);
    }

    public function edit($id){
        $instructor = Instructor::where('ID_INSTRUKTUR',$id)->first();

        return view('instructor/instructor_edit')->with([
            'user' => Auth::guard('pegawai')->user(),
            'instructor' => $instructor,
        ]);
    }

    public function store(Request $request) {

        Session::flash('NAMA_INSTRUKTUR',$request->NAMA_INSTRUKTUR);
        Session::flash('ALAMAT_INSTRUKTUR',$request->ALAMAT_INSTRUKTUR);
        Session::flash('TELEPON_INSTRUKTUR',$request->TELEPON_INSTRUKTUR);
        Session::flash('UMUR_INSTRUKTUR',$request->UMUR_INSTRUKTUR);
        Session::flash('JENIS_KELAMIN_INSTRUKTUR',$request->JENIS_KELAMIN_INSTRUKTUR);
        // Session::flash('TANGGAL_LAHIR_INSTRUKTUR',$request->TANGGAL_LAHIR_INSTRUKTUR);
        Session::flash('EMAIL_INSTRUKTUR',$request->EMAIL_INSTRUKTUR);
        Session::flash('password',$request->password);

        $validate = $request->validate([
            'NAMA_INSTRUKTUR' => ['required'],
            'ALAMAT_INSTRUKTUR'=> ['required'],
            'TELEPON_INSTRUKTUR' => ['required','numeric'],
            'UMUR_INSTRUKTUR' => ['required','numeric'],
            'JENIS_KELAMIN_INSTRUKTUR'=> ['required'],
            'TANGGAL_LAHIR_INSTRUKTUR'=> ['required','date_format:Y-m-d'],
            'EMAIL_INSTRUKTUR' => ['required', 'email:rfc,dns','unique:instruktur'],
            'password' => ['required'],
        ],[
            'NAMA_INSTRUKTUR.required' => 'The name field is required',
            'ALAMAT_INSTRUKTUR.required' => 'The address field is required',
            'TANGGAL_LAHIR_INSTRUKTUR.required' => 'The date of birth field is required',
            'TANGGAL_LAHIR_INSTRUKTUR.date_format' => 'The date of birth not formated yyyy-mm-dd',
            'TELEPON_INSTRUKTUR.required' => 'The call number field is required',
            'TELEPON_INSTRUKTUR.numeric' => 'Format call number using numeric ',
            'UMUR_INSTRUKTUR.required' => 'The age field is required',
            'UMUR_INSTRUKTUR.numeric' => 'Format age using numeric',
            'JENIS_KELAMIN_INSTRUKTUR.required' => 'The gender field is required',
            'EMAIL_INSTRUKTUR.required' => 'The email field is required',
            'EMAIL_INSTRUKTUR.email' => 'Format email using @',
            'EMAIL_INSTRUKTUR.unique' => 'Email has already been taken',
            'password.required' => 'The password field is required',
        ]);

        $datainstructor = $request->all();

        $datainstructor['password'] = \bcrypt($request->password);

        $instructor = Instructor::create($datainstructor);

        if($instructor) {
            return redirect()->intended('dashboard/instructor')->with(['success' => 'Successfully added instructor']);
        }
        return redirect()->intended('dashboard/create-instructor')->with(['error' => 'Failed added instructor']);
    }

    public function update(Request $request, $id) {
        $instructor = Instructor::where('ID_INSTRUKTUR',$id)->first();

        if($request->NAMA_INSTRUKTUR) {
            $instructor->NAMA_INSTRUKTUR = $request->NAMA_INSTRUKTUR;
        }
        if($request->ALAMAT_INSTRUKTUR){
            $instructor->ALAMAT_INSTRUKTUR = $request->ALAMAT_INSTRUKTUR;
        }
        if($request->TELEPON_INSTRUKTUR){
            $instructor->TELEPON_INSTRUKTUR = $request->TELEPON_INSTRUKTUR;
        }
        if($request->UMUR_INSTRUKTUR){
            $instructor->UMUR_INSTRUKTUR = $request->UMUR_INSTRUKTUR;
        }
        if($request->JENIS_KELAMIN_INSTRUKTUR){
            $instructor->JENIS_KELAMIN_INSTRUKTUR = $request->JENIS_KELAMIN_INSTRUKTUR;
        }
        if($request->TANGGAL_LAHIR_INSTRUKTUR){
            $instructor->TANGGAL_LAHIR_INSTRUKTUR = $request->TANGGAL_LAHIR_INSTRUKTUR;
        }
        if($request->EMAIL_INSTRUKTUR){
            $instructor->EMAIL_INSTRUKTUR = $request->EMAIL_INSTRUKTUR;
        }
        if($request->password){
            $instructor->password = \bcrypt ($request->password);
        }
        
        $instructor_update = Instructor::where('ID_INSTRUKTUR', $id)
        ->limit(1) 
        ->update(array('NAMA_INSTRUKTUR' => $instructor->NAMA_INSTRUKTUR, 
        'ALAMAT_INSTRUKTUR' => $instructor->ALAMAT_INSTRUKTUR,
        'TELEPON_INSTRUKTUR' => $instructor->TELEPON_INSTRUKTUR,
        'UMUR_INSTRUKTUR' => $instructor->UMUR_INSTRUKTUR,
        'JENIS_KELAMIN_INSTRUKTUR'=> $instructor->JENIS_KELAMIN_INSTRUKTUR,
        'TANGGAL_LAHIR_INSTRUKTUR' => $instructor->TANGGAL_LAHIR_INSTRUKTUR,
        'EMAIL_INSTRUKTUR' => $instructor->EMAIL_INSTRUKTUR,
        'password' => $instructor->password),
    ); 

        if($instructor_update) {
            return redirect()->intended('dashboard/instructor')->with(['success' => 'Successfully update instructor']);
        }
        return redirect()->intended('dashboard/edit-instructor/'.$id)->with(['error' => 'Failed update instructor']);
    }

    public function destroy($id) {
        $instructor = Instructor::where('ID_INSTRUKTUR',$id);

        try {
            if($instructor) {
                $instructor->delete();
                return redirect()->intended('dashboard/instructor')->with([
                    'success' => 'Instructor has been successfully deleted'
                ]);
            }else {
                return redirect()->intended('dashboard/m')->with([
                    'error' => 'Instructor not deleted successfully'
                ]);
            }
        } catch ( \Exception $e) {
            //   var_dump($e->errorInfo );
            return redirect()->back()->with('error', "Data cant be delete because use on another data master");
        }
        
    }

    public function reset_late_index(){
        $instructor = Instructor::orderby('ID_INSTRUKTUR','asc')->paginate(20);
        
        return view('instructor/instructor-reset_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'instructors' => $instructor,
        ]);
    }

    public function reset_late(){
        $instructor = Instructor::all();
        
        if($instructor){
            if($instructor->first()->expired_reset_terlambat < Carbon::now() || $instructor->first()->expired_reset_terlambat == null ) {
                foreach($instructor as $item){
                    $item->JUMLAH_TERLAMBAT = 0;
                    $item->expired_reset_terlambat = Carbon::now()->addMonths(1);
                    $item->update();
                }
                return redirect()->intended('dashboard/reset-late-instructor')->with(['success' => 'Succesfully reset instructor late. You can reset again on '.$item->expired_reset_terlambat]);
            }else {
                
                return redirect()->intended('dashboard/reset-late-instructor')->with(['error' => 'Failed reset instructor late. You can reset again on '.$instructor->first()->expired_reset_terlambat]);
            }
            
        }
        return redirect()->intended('dashboard/reset-late-instructor')->with(['error' => 'Failed reset instructor late']);
    }

    public function instructor_profile(Request $request,$id){
        if($request->expectsJson()){
            $instructor = Instructor::where('ID_INSTRUKTUR',$id)->first();

            if($instructor){
                return response([
                    'message' => 'success get data instructor',
                    'data' => $instructor
                ],200);
            }
            return response([
                'message' => 'data empty',
                'data' => $null
            ],400);
        }
    }
}