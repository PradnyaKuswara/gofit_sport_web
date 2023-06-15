<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstructorPermission;
use App\Models\DailySchedule;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InstructorPermissionController extends Controller
{
    public function index() {
        $permission = InstructorPermission::orderby('ID_IZIN_INSTRUKTUR','asc')->where('TANGGAL_KONFIRMASI_IZIN',null)->paginate(20);
        $permission_all = InstructorPermission::paginate(20);

        return view('instructor-permission/instructor-permission_view')->with([
            'user' => Auth::guard('pegawai')->user(),
            'permissions' => $permission,
            'permissions_all' => $permission_all
        ]);
    }

    public function confirmation($id) {
        $permission = InstructorPermission::orderby('ID_IZIN_INSTRUKTUR','asc')->where('ID_IZIN_INSTRUKTUR',$id)->first();

        if($permission){
            $permission->TANGGAL_KONFIRMASI_IZIN = Carbon::now();
            $permission->STATUS_IZIN = 'dikonfirmasi';
            $schedule = DailySchedule::where("TANGGAL_JADWAL_HARIAN",$permission->TANGGAL_IZIN_INSTRUKTUR)->first();
            if($schedule) {
                if($permission->NAMA_INSTRUKTUR_PENGGANTI){
                    $instructor = Instructor::where('NAMA_INSTRUKTUR',$permission->NAMA_INSTRUKTUR_PENGGANTI)->first();
                    $instructor2 = Instructor::where('ID_INSTRUKTUR',$schedule->ID_INSTRUKTUR)->first();
                    if($instructor) {
                        $schedule->ID_INSTRUKTUR = $instructor->ID_INSTRUKTUR;
                        $schedule->KETERANGAN_JADWAL_HARIAN = "menggantikan ".$instructor2->NAMA_INSTRUKTUR;
                    }
                }else {
                    $schedule->KETERANGAN_JADWAL_HARIAN = 'Libur';
                } 
                $schedule->update();
            }
            $permission->update();
            return redirect()->intended('dashboard/instructor-permission')->with(['success' => 'Sucessfully Confirmation']);
        }
        return redirect()->intended('dashboard/instructor-permission')->with(['error' => 'Failed Confirmation']);
    }

    public function store(Request $request){
        if($request->expectsJson()){
            $validate = Validator::make($request->all(),[
                'ID_INSTRUKTUR' => ['required'],
                'TANGGAL_IZIN_INSTRUKTUR' => ['required'],
                'KETERANGAN_IZIN' => ['required'],
            ]);

            if($validate->fails()) {
                return response(['success' => false,'message' => $validate->errors()],400);   
            }

            if($request->NAMA_INSTRUKTUR_PENGGANTI){
                $instructor = Instructor::where('NAMA_INSTRUKTUR',$request->NAMA_INSTRUKTUR_PENGGANTI)->first();
                if($instructor) {
                    $temp_instructor = $instructor->NAMA_INSTRUKTUR;
                }else {
                    return response([
                        'message' => 'Instructor Substitute Not Found',
                        'data' => null,
                    ], 400);
                }
            }else {
                $temp_instructor = null;
            }

            $check = InstructorPermission::where('TANGGAL_IZIN_INSTRUKTUR',$request->TANGGAL_IZIN_INSTRUKTUR)->exists();

            if($check) {
                return response([
                    'message' => 'You have been create permission on this date',
                    'data' => null,
                ],400);
            }

            $store_data = InstructorPermission::create([
                'ID_INSTRUKTUR' => $request->ID_INSTRUKTUR,
                'NAMA_INSTRUKTUR_PENGGANTI' => $temp_instructor,
                'TANGGAL_IZIN_INSTRUKTUR' => $request->TANGGAL_IZIN_INSTRUKTUR,
                'KETERANGAN_IZIN' => $request->KETERANGAN_IZIN,
                'TANGGAL_MELAKUKAN_IZIN' => Carbon::now(),
                'STATUS_IZIN' => null,
                'TANGGAL_KONFIRMASI_IZIN' => null,
            ]);

            if($store_data) {
                return response([
                    'message' => 'Successfully added permission',
                    'data' => $store_data,
                ],200);
            }
            return response([
                'message' => 'Failed added permission',
                'data' => null,
            ],400);
        }
    }

    public function getData(Request $request){
        if($request->expectsjson()){
            // $permission = InstructorPermission::where('ID_INSTRUKTUR',$id)->get();
            $permission = DB::table('izin_instruktur')->select('ID_INSTRUKTUR','NAMA_INSTRUKTUR_PENGGANTI',DB::raw('DATE_FORMAT(TANGGAL_IZIN_INSTRUKTUR, "%d-%b-%Y %H:%i:%s") as TANGGAL_IZIN_INSTRUKTUR'),'KETERANGAN_IZIN',DB::raw('DATE_FORMAT(TANGGAL_MELAKUKAN_IZIN, "%d-%b-%Y %H:%i:%s") as TANGGAL_MELAKUKAN_IZIN'),'STATUS_IZIN',DB::raw('DATE_FORMAT(TANGGAL_KONFIRMASI_IZIN, "%d-%b-%Y %H:%i:%s") as TANGGAL_KONFIRMASI_IZIN'))
            ->where('ID_INSTRUKTUR',$request->ID_INSTRUKTUR)
            ->whereRaw('MONTHNAME(TANGGAL_IZIN_INSTRUKTUR) = ?',[$request->BULAN])
            ->whereRaw('YEAR(TANGGAL_IZIN_INSTRUKTUR) = ?',[$request->TAHUN])
            ->get();
            if($permission){
                return response([
                    'message' => 'Successfully get data permission',
                    'data' => $permission,
                ],200);
            }
            return response([
                'message' => 'Failed get data permission',
                'data' => null,
            ],200);
        }
    }
    
    public function getDataSchedule(Request $request, $id){
        if($request->expectsjson()){
            $schedule = DailySchedule::where('ID_INSTRUKTUR',$id)->where('TANGGAL_JADWAL_HARIAN','>',Carbon::now())->get();
            if($schedule){
                return response([
                    'message' => 'Successfully get data permission',
                    'data' => $schedule,
                ],200);
            }
            return response([
                'message' => 'Failed get data permission',
                'data' => null,
            ],200);
        }
    }

    
}