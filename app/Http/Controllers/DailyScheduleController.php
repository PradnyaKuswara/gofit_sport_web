<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSchedule;
use App\Models\DailySchedule;
use App\Models\Instructor;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class DailyScheduleController extends Controller
{
    public function index(){
        $schedule_daily = DailySchedule::where('expired_at','>=',Carbon::now()->format('Y-m-d'))->orderBy('TANGGAL_JADWAL_HARIAN','asc')->get();
        // $schedule_date = DailySchedule::first();
        $schedule_date = DailySchedule::where('expired_at','>=',Carbon::now()->format('Y-m-d'))->first();

        return view('daily-schedule/daily-schedule_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'schedule_daily' => $schedule_daily,
            'day' => $schedule_date,
        ]);
    }

    public function generate_schedule(){
        $general_schedule = GeneralSchedule::all();
        // $schedule_date = DailySchedule::where('expired_at','>=',Carbon::now())->first();

        $check_generate = DailySchedule::where('expired_at', '>=' ,Carbon::now()->format('Y-m-d'))->latest('expired_at')->first();

        if($check_generate) {
            return redirect()->intended('dashboard/daily-schedule')->with(['error' => 'Daily schedule has been generated. You can generate again on the date after '. $check_generate->expired_at ]);
        }else {
            // DailySchedule::truncate();
            $expired = Carbon::now()->addDays(6)->format('Y-m-d H:i:s');
            for($i=Carbon::now();$i<=Carbon::now()->addDays(6);$i->modify('+1 day')){
                $day = Carbon::createFromFormat('Y-m-d H:i:s', $i)->translatedformat('l');
                foreach($general_schedule as $item){
                    if($day == $item->HARI_JADWAL){
                        $daily = DailySchedule::create([
                            'TANGGAL_JADWAL_HARIAN' => $i->format('Y-m-d').' '.$item->WAKTU_JADWAL,
                            'ID_INSTRUKTUR' => $item->ID_INSTRUKTUR,
                            'ID_JADWAL_UMUM' => $item->ID_JADWAL_UMUM,
                            'KETERANGAN_JADWAL_HARIAN' => '-',
                            'expired_at' => $expired,
                        ]);
                    }
                }
            }
            return redirect()->intended('dashboard/daily-schedule')->with(['success' => 'Succesfully generate daily schedule']);
        }
    }

    public function edit($id){
        $schedule = DailySchedule::where('TANGGAL_JADWAL_HARIAN',$id)->first();
        $instructor = Instructor::all();

        return view('daily-schedule/daily-schedule_edit')->with([
            'user' => Auth::guard('pegawai')->user(),
            'schedule_daily' => $schedule,
            'instructors' => $instructor
        ]);
    }

    public function abolished($id) {
        $schedule = DailySchedule::where('TANGGAL_JADWAL_HARIAN',$id)->first();

        if($schedule->KETERANGAN_JADWAL_HARIAN == "Libur") {
            return redirect()->intended('dashboard/daily-schedule')->with(['error' => 'Schedule has been updated to Libur']);
        }

        $schedule->KETERANGAN_JADWAL_HARIAN = 'Libur';
        $schedule_update = $schedule->update();
        
        if($schedule_update) {
            return redirect()->intended('dashboard/daily-schedule')->with(['success' => 'Succesfully update daily schedule']);
        }
        return redirect()->intended('dashboard/daily-schedule')->with(['error' => 'Failed update daily schedule']);
    }

    public function update(Request $request, $id){
        $schedule = DailySchedule::where('TANGGAL_JADWAL_HARIAN',$id)->first();

        if($request->KETERANGAN_JADWAL_HARIAN) {
            $schedule->KETERANGAN_JADWAL_HARIAN = $request->KETERANGAN_JADWAL_HARIAN;
        }
        if($request->ID_INSTRUKTUR){
            $schedule->ID_INSTRUKTUR = $request->ID_INSTRUKTUR;
        }

        $schedule_check = GeneralSchedule::where('ID_INSTRUKTUR',$request->ID_INSTRUKTUR)->where('HARI_JADWAL',$request->HARI_JADWAL)->where('WAKTU_JADWAl',$request->WAKTU_JADWAL)->first();

        if($schedule_check) {
            return redirect()->intended('dashboard/edit-daily-schedule/'.$id)->with(['error' => 'Instructor has been scheduled']);
        }

        $schedule_update = $schedule->update();
        
        if($schedule_update) {
            return redirect()->intended('dashboard/daily-schedule')->with(['success' => 'Succesfully update daily schedule']);
        }
        return redirect()->intended('dashboard/daily-schedule')->with(['error' => 'Failed update daily schedule']);
    }

    public function search(Request $request){
        // $schedule_date = DailySchedule::where('expired_at','<=',Carbon::now());
        $schedule_date = DailySchedule::where('expired_at','>=',Carbon::now())->first();
        if($request->keyword != null) {
            $instructor = Instructor::where('NAMA_INSTRUKTUR',$request->keyword)->first();
            $kelas = Kelas::where('NAMA_KELAS',$request->keyword)->first();
            if($instructor) {
                // $daily_schedule = DailySchedule::where('TANGGAL_JADWAL_HARIAN',$request->keyword)->orWhere('ID_INSTRUKTUR',$instructor->ID_INSTRUKTUR)->orWhere('ID_JADWAL_UMUM',$general_schedule->ID_JADWAL_UMUM)->orWhere('KETERANGAN_JADWAL_HARIAN',$request->keyword);
                $daily_schedule = DailySchedule::where('ID_INSTRUKTUR',$instructor->ID_INSTRUKTUR)->where('expired_at',$schedule_date->expired_at)->get();
            }
            else if($kelas){
                //MASIH AMBIGU
                $general_schedule = GeneralSchedule::where('ID_KELAS',$kelas->ID_KELAS)->get();
                $daily_schedule = DailySchedule::whereIn('ID_JADWAL_UMUM',$general_schedule->pluck('ID_JADWAL_UMUM'))->where('expired_at',$schedule_date->expired_at)->get();
                // $daily_schedule = DB::select('SELECT * from jadwal_harian jh 
                // join jadwal_umum ju ON (jh.ID_JADWAL_UMUM = ju.ID_JADWAL_UMUM) 
                // join kelas k on (ju.ID_KELAS = k.ID_KELAS)
                // where k.NAMA_KELAS LIKE "%'.$kelas->NAMA_KELAS.'%"
                // ');
            }else {
                $daily_schedule = DailySchedule::where('TANGGAL_JADWAL_HARIAN','like','%'.$request->keyword.'%')
                ->where('expired_at',$schedule_date->expired_at)
                ->orWhere('KETERANGAN_JADWAL_HARIAN','like','%'.$request->keyword.'%')
                ->where('expired_at',$schedule_date->expired_at)
                ->get();
            }
        }
        else {
            $daily_schedule = DailySchedule::orderby('TANGGAL_JADWAL_HARIAN','asc')->where('expired_at',$schedule_date->expired_at)->get();
        }
        
        return view('daily-schedule/daily-schedule_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'schedule_daily' => $daily_schedule,
            'day' => $schedule_date
        ]);
    }

    //api

    public function index_api(Request $request){
        if($request->expectsjson()){
            $schedule_daily = DB::table('jadwal_harian as jh')->select('jh.TANGGAL_JADWAL_HARIAN','i.NAMA_INSTRUKTUR','k.NAMA_KELAS','ju.ID_KELAS','jh.KETERANGAN_JADWAL_HARIAN','ju.HARI_JADWAL', 'k.TARIF')
            ->join('instruktur as i','jh.ID_INSTRUKTUR','i.ID_INSTRUKTUR')
            ->join('jadwal_umum as ju','jh.ID_JADWAL_UMUM','ju.ID_JADWAL_UMUM')
            ->join('kelas as k','ju.ID_KELAS','k.ID_KELAS')
            ->where('jh.TANGGAL_JADWAL_HARIAN','>',Carbon::now())
            ->orderby('jh.TANGGAL_JADWAL_HARIAN','asc')->get();
            if($schedule_daily){
                return response([
                    'message' => 'Successfully get data schedule',
                    'data' => $schedule_daily,
                ],200);
            }
            return response([
                'message' => 'Successfully get data permission',
                'data' => null,
            ],400);
        }
    }
}