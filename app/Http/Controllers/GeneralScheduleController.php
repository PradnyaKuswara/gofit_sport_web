<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSchedule;
use App\Models\Kelas;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;
use Validator;

class GeneralScheduleController extends Controller
{
    public function index() {
        $schedule = GeneralSchedule::orderBy('WAKTU_JADWAL','asc')->get();

        return view('general-schedule/general-schedule_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'schedules' => $schedule
        ]);
    }

    public function create(){
        $kelas = Kelas::all();
        $instructor = Instructor::all();
        return view('general-schedule/general-schedule_create')->with([
            'user' => Auth::guard('pegawai')->user(),
            'kelas' => $kelas,
            'instructors' => $instructor
        ]);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'ID_KELAS' => ['required', 'numeric'],
            'ID_INSTRUKTUR' => ['required','numeric'],
            'HARI_JADWAL' => ['required'],
            'WAKTU_JADWAL' => ['required','date_format:H:i:s'],
            // 'TANGGAL_JADWAL' => ['required','date_format:Y-m-d']
        ],[
            'ID_KELAS.required' => 'The kelas field is required',
            'ID_INSTRUKTUR.required' => 'The instructor field is required',
            'HARI_JADWAL' => 'The day field is required',
            'WAKTU_JADWAL' => 'The time field is required',
            'WAKTU_JADWAL.date_format' => 'The time field not formated'
        ]);

        $dataschedule = $request->all();

        //cek apakah jadwal instruktur bertabrakan
        $schedule_check = GeneralSchedule::where('ID_INSTRUKTUR',$request->ID_INSTRUKTUR)->where('HARI_JADWAL',$request->HARI_JADWAL)->where('WAKTU_JADWAl',$request->WAKTU_JADWAL)->first();

        if($schedule_check) {
            return redirect()->intended('dashboard/create-general-schedule')->with(['error' => 'Instructor has been scheduled']);
        }else {
            $schedule = GeneralSchedule::create($dataschedule);

            if($schedule) {
                return redirect()->intended('dashboard/general-schedule')->with(['success' => 'Successfully added Schedule']);
            }
            return redirect()->intended('dashboard/create-general-schedule')->with(['error' => 'Failed added Schedule']);
        }
    }

    public function edit($id){
        $schedule = GeneralSchedule::where('ID_JADWAL_UMUM',$id)->first();
        $kelas = Kelas::all();
        $instructor = Instructor::all();

        return view('general-schedule/general-schedule_edit')->with([
            'user' => Auth::guard('pegawai')->user(),
            'schedule' => $schedule,
            'kelas' => $kelas,
            'instructors' => $instructor
        ]);
    }

    public function update(Request $request,$id) {
        $schedule = GeneralSchedule::find($id);
        $temp_schedule = GeneralSchedule::find($id);

        if($request->ID_KELAS != $temp_schedule->ID_KELAS && $request->ID_INSTRUKTUR == $temp_schedule->ID_INSTRUKTUR && $request->HARI_JADWAL == $temp_schedule->HARI_JADWAL && $request->WAKTU_JADWAL == $temp_schedule->WAKTU_JADWAL) {
            $schedule->ID_KELAS = $request->ID_KELAS;
            $schedule->update();
            if($schedule) {
                return redirect()->intended('dashboard/general-schedule')->with(['success' => 'Successfully update scheduleee']);
            }
            return redirect()->intended('dashboard/edit-general-schedule/'.$id)->with(['error' => 'Failed update schedule']);
        }
        // if($request->ID_KELAS != $temp_schedule->ID_KELAS && $request->ID_INSTRUKTUR != $temp_schedule->ID_INSTRUKTUR) {
        //     $schedule->ID_KELAS = $request->ID_KELAS;
        //     $schedule->update();
        //     if($schedule) {
        //         return redirect()->intended('dashboard/general-schedule')->with(['success' => 'Successfully update schedule']);
        //     }
        //     return redirect()->intended('dashboard/edit-general-schedule/'.$id)->with(['error' => 'Failed update schedule']);
        // }
        // if($request->ID_KELAS != $temp_schedule->ID_KELAS && $request->HARI_JADWAL != $temp_schedule->HARI_JADWAL) {
        //     $schedule->ID_KELAS = $request->ID_KELAS;
        //     $schedule->update();
        //     if($schedule) {
        //         return redirect()->intended('dashboard/general-schedule')->with(['success' => 'Successfully update schedule']);
        //     }
        //     return redirect()->intended('dashboard/edit-general-schedule/'.$id)->with(['error' => 'Failed update schedule']);
        // }
        // if($request->ID_KELAS != $temp_schedule->ID_KELAS && $request->WAKTU_JADWAL != $temp_schedule->WAKTU_JADWAL) {
        //     $schedule->ID_KELAS = $request->ID_KELAS;
        //     $schedule->update();
        //     if($schedule) {
        //         return redirect()->intended('dashboard/general-schedule')->with(['success' => 'Successfully update schedule']);
        //     }
        //     return redirect()->intended('dashboard/edit-general-schedule/'.$id)->with(['error' => 'Failed update schedule']);
        // }
        if($request->ID_INSTRUKTUR){
            $schedule->ID_INSTRUKTUR = $request->ID_INSTRUKTUR;
        }
        if($request->HARI_JADWAL){
            $schedule->HARI_JADWAL = $request->HARI_JADWAL;
        }
        if($request->WAKTU_JADWAL){
            $schedule->WAKTU_JADWAL = $request->WAKTU_JADWAL;
        }
        

        $schedule_check = GeneralSchedule::where('ID_INSTRUKTUR',$request->ID_INSTRUKTUR)->where('HARI_JADWAL',$request->HARI_JADWAL)->where('WAKTU_JADWAl',$request->WAKTU_JADWAL)->first();

        if($schedule_check) {
            return redirect()->intended('dashboard/edit-general-schedule/'.$id)->with(['error' =>'Instructor has been scheduled']);
        }else {
            $schedule->ID_KELAS = $request->ID_KELAS;
            $schedule_update = $schedule->update();

            if($schedule_update) {
                return redirect()->intended('dashboard/general-schedule')->with(['success' => 'Successfully update schedule']);
            }
            return redirect()->intended('dashboard/edit-general-schedule/'.$id)->with(['error' => 'Failed update schedule']);
        }
        
    }

    public function destroy($id) {
        $schedule = GeneralSchedule::find($id);

        try {
            if($schedule) {
                $schedule->delete();
                return redirect()->intended('dashboard/general-schedule')->with([
                    'success' => 'Schedule has been successfully deleted'
                ]);
            }else {
                return redirect()->intended('dashboard/general-schedule')->with([
                    'error' => 'Schedule not deleted successfully'
                ]);
            }
         } catch ( \Exception $e) {
            //   var_dump($e->errorInfo );
              return redirect()->back()->with('error', "Data cant be delete because use on another data master");
         }
    }
}