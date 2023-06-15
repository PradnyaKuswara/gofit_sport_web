<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookingGym;
use App\Models\Member;
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingGymController extends Controller
{
    public function index(Request $request){
        if($request->accepts('text/html')){
            $booking_gym = BookingGym::orderBy('KODE_BOOKING_GYM','desc')->where('STATUS_PRESENSI_GYM',null)->paginate(20);
            $booking_gym_after = BookingGym::orderBy('KODE_BOOKING_GYM','desc')->where('STATUS_PRESENSI_GYM','!=',null)->paginate(20);

            return view('presensi-booking-gym/presensi-booking-gym_view')->with([
                'user' => Auth::guard('pegawai')->user(),
                'booking_gym' => $booking_gym,
                'booking_gym_after' => $booking_gym_after, 
            ]);            
        }
    }

    public function confirmation_gym(Request $request,$id){
        if($request->accepts('text/html')){
            $booking = BookingGym::where('KODE_BOOKING_GYM',$id)->first();
            if($booking){
                $booking->WAKTU_KONFIRMASI_PRESENSI = Carbon::now();
                $booking->STATUS_PRESENSI_GYM = 'Hadir';
                $booking->update();
                return redirect()->intended('dashboard/presensi-booking-gym')->with(['success' => 'Successfully confirm booking gym']);
            }
            return redirect()->intended('dashboard/presensi-booking-gym')->with(['error' => 'Failed confirm booking gym']);
        }
    }

    public function booking_receipt($id){
        $presensies = BookingGym::where('KODE_BOOKING_GYM',$id)->first();
        return view('presensi-booking-gym/presensi-receipt')->with([
            'presensies' => $presensies,
        ]);
    }

    public function store(Request $request){
        if($request->expectsJson()){
            $validate = Validator::make($request->all(),[
                'ID_MEMBER' => ['required'],
                'SLOT_WAKTU_GYM' => ['required'],
                'TANGGAL_BOOKING_GYM' => ['required'],
            ]);
    
            if($validate->fails()) {
                return response(['success' => false,'message' => $validate->errors()],400);   
            }

            if($request->TANGGAL_BOOKING_GYM < Carbon::now()->format('Y-m-d')){
                return response([
                    'message' => 'please input date more than or same date now ',
                    'data' => null,
                ], 400);
            }

            $member = Member::where('ID_MEMBER',$request->ID_MEMBER)->first();

            if($member->MASA_AKTIVASI == null || $member->MASA_AKTIVASI < Carbon::now()){
                return response([
                    'message' => 'You not activated ',
                    'data' => null,
                ], 400);
            }

            $check_duplicate = BookingGym::where('ID_MEMBER',$request->ID_MEMBER)->where('TANGGAL_BOOKING_GYM',$request->TANGGAL_BOOKING_GYM)->where('SLOT_WAKTU_GYM',$request->SLOT_WAKTU_GYM)->first();
            if($check_duplicate) {
                return response([
                    'message' => 'You have been booking this class',
                    'data' => null,
                ], 400);
            }

            $check = BookingGym::where('SLOT_WAKTU_GYM',$request->SLOT_WAKTU_GYM)->where('TANGGAL_BOOKING_GYM',$request->TANGGAL_BOOKING_GYM)->count();

            if($check <= 10){
                $store_data = BookingGym::create([
                    'ID_MEMBER' => $request->ID_MEMBER,
                    'SLOT_WAKTU_GYM' => $request->SLOT_WAKTU_GYM,
                    'TANGGAL_BOOKING_GYM' => $request->TANGGAL_BOOKING_GYM,
                    'TANGGAL_MELAKUKAN_BOOKING' => Carbon::now(),
                    'WAKTU_KONFIRMASI_PRESENSI' => null,
                    'STATUS_PRESENSI_GYM' => null,
                ]);
                
                if($store_data){
                    return response([
                        'message' => 'Succesfully create booking gym',
                        'data' => $store_data,
                        // 'data_depo' => $member_deposit
                    ], 200);
                }else {
                    return response([
                        'message' => 'Failed create store booking gym',
                        'data' => null,
                    ], 400);
                }
            }else {
                return response([
                    'message' => 'Class Gym Full',
                    'data' => null,
                ], 400);
            }
        }
    }

    public function index_booking_gym(Request $request){
        // $booking = BookingGym::where('ID_MEMBER',$request->ID_MEMBER)
        // ->whereRaw('MONTHNAME(TANGGAL_BOOKING_GYM) = ?',[$request->BULAN])
        // ->whereRaw('YEAR(TANGGAL_BOOKING_GYM) = ?',[$request->TAHUN])
        // ->get();

        $booking = DB::table('booking_gym')->select('KODE_BOOKING_GYM','ID_MEMBER','SLOT_WAKTU_GYM',DB::raw('DATE_FORMAT(TANGGAL_BOOKING_GYM, "%d-%b-%Y %H:%i:%s") as TANGGAL_BOOKING_GYM'),DB::raw('DATE_FORMAT(TANGGAL_MELAKUKAN_BOOKING, "%d-%b-%Y %H:%i:%s") as TANGGAL_MELAKUKAN_BOOKING'),DB::raw('DATE_FORMAT(WAKTU_KONFIRMASI_PRESENSI, "%d-%b-%Y %H:%i:%s") as WAKTU_KONFIRMASI_PRESENSI'),'STATUS_PRESENSI_GYM')
        ->where('ID_MEMBER',$request->ID_MEMBER)
        ->whereRaw('MONTHNAME(TANGGAL_BOOKING_GYM) = ?',[$request->BULAN])
        ->whereRaw('YEAR(TANGGAL_BOOKING_GYM) = ?',[$request->TAHUN])
        ->get();

        if($booking){
            return response([
                'message' => 'Succesfully get data',
                'data' => $booking,
            ], 200);
        }
        return response([
            'message' => 'Failed get data',
            'data' => null,
        ], 400);
    }

    public function cancelBookingGym($id){
        $booking = BookingGym::where('KODE_BOOKING_GYM',$id)->first();

        if($booking){
            if(Carbon::now()->format('Y-m-d') <= Carbon::parse($booking->TANGGAL_BOOKING_GYM)->subDays(1)){
                $booking->delete();
                return response([
                    'message' => 'Succesfully cancel booking',
                    'data' => $booking,
                ], 200);
            }else {
                return response([
                    'message' => 'You can cancel booking class max h-1 day',
                    'data' => null,
                ], 400); 
            }
        }
        return response([
            'message' => 'Failed cancel booking',
            'data' => null,
        ], 400);
    }
}