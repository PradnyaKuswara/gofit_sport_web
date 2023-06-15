<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookingClass;
use App\Models\DailySchedule;
use App\Models\GeneralSchedule;
use App\Models\Member;
use App\Models\Kelas;
use App\Models\DepoClassTransaction;
use App\Models\InstructorAttendance;
use App\Models\MemberDepositClass;
use Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class BookingClassController extends Controller
{
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'ID_MEMBER' => ['required'],
            'ID_KELAS' => ['required'],
            'TANGGAL_JADWAL_HARIAN' => ['required'],
        ]);

        if($validate->fails()) {
            return response(['success' => false,'message' => $validate->errors()],400);   
        }
        
        $member = Member::where('ID_MEMBER',$request->ID_MEMBER)->first();
        $kelas = Kelas::where('ID_KELAS',$request->ID_KELAS)->first();
        $member_deposit = MemberDepositClass::where('ID_MEMBER',$request->ID_MEMBER)->where('ID_KELAS',$request->ID_KELAS)->first();

        if($member_deposit && $member_deposit->MASA_BERLAKU > Carbon::now() && $member_deposit->DEPO_SISA != 0){
            
            if($member->MASA_AKTIVASI == null || $member->MASA_AKTIVASI < Carbon::now()){
                return response([
                    'message' => 'You not activated ',
                    'data' => null,
                ], 400);
            }
            
            $check_duplicate = BookingClass::where('ID_MEMBER',$request->ID_MEMBER)->where('TANGGAL_JADWAL_HARIAN',$request->TANGGAL_JADWAL_HARIAN)->first();
            if($check_duplicate) {
                return response([
                    'message' => 'You have been booking this class',
                    'data' => null,
                ], 400);
            }
            
            $check = BookingClass::where('TANGGAL_JADWAL_HARIAN',$request->TANGGAL_JADWAL_HARIAN)->count();
            if($check < $kelas->KAPASITAS) {
                $store_data = BookingClass::create([
                    'ID_MEMBER' => $request->ID_MEMBER,
                    'TANGGAL_JADWAL_HARIAN' => $request->TANGGAL_JADWAL_HARIAN,
                    'TANGGAL_MELAKUKAN_BOOKING' => Carbon::now(),
                    'TARIF_KELAS' => 1,
                    'WAKTU_KONFIRMASI_PRESENSI_KELAS' => null,
                    'STATUS_PRESENSI_KELAS' => null,
                ]);

                if($store_data) {
                    // $member_deposit->DEPO_SISA -= 1;
                    // $member_deposit->update();
                    
                    // if($member_deposit){
                        return response([
                            'message' => 'Succesfully create data',
                            'data' => $store_data,
                            // 'data_depo' => $member_deposit
                        ], 200);
                    // }else {
                    //     return response([
                    //         'message' => 'Failed create store member deposit class',
                    //         'data' => null,
                    //     ], 400);
                    // }
                }else {
                    return response([
                        'message' => 'Failed create store booking class',
                        'data' => null,
                    ], 400); 
                }
            }else {
                return response([
                    'message' => 'Class Full',
                    'data' => null,
                ], 400);
            }
        }else if($member->SISA_DEPOSIT_MEMBER != 0 && $member->SISA_DEPOSIT_MEMBER > $kelas->TARIF){
            
            if($member->MASA_AKTIVASI == null || $member->MASA_AKTIVASI < Carbon::now()){
                return response([
                    'message' => 'You not activated',
                    'data' => null,
                ], 400);
            }
            
            $check_duplicate = BookingClass::where('ID_MEMBER',$request->ID_MEMBER)->where('TANGGAL_JADWAL_HARIAN',$request->TANGGAL_JADWAL_HARIAN)->first();
            if($check_duplicate) {
                return response([
                    'message' => 'You have been booking this class',
                    'data' => null,
                ], 400);
            }
            
            $check = BookingClass::where('TANGGAL_JADWAL_HARIAN',$request->TANGGAL_JADWAL_HARIAN)->count();
            if($check < $kelas->KAPASITAS) {
                $store_data = BookingClass::create([
                    'ID_MEMBER' => $request->ID_MEMBER,
                    'TANGGAL_JADWAL_HARIAN' => $request->TANGGAL_JADWAL_HARIAN,
                    'TANGGAL_MELAKUKAN_BOOKING' => Carbon::now(),
                    'TARIF_KELAS' => $kelas->TARIF,
                    'WAKTU_KONFIRMASI_PRESENSI_KELAS' => null,
                    'STATUS_PRESENSI_KELAS' => null,
                ]);

                if($store_data){
                    // $member->SISA_DEPOSIT_MEMBER = $member->SISA_DEPOSIT_MEMBER - $kelas->TARIF;
                    // $member->update();
                    return response([
                        'message' => 'Succesfully create data',
                        'data' => $store_data,
                    ], 200);
                }else {
                    return response([
                        'message' => 'Failed create store booking class',
                        'data' => null,
                    ], 400); 
                }
            }else {
                return response([
                    'message' => 'Class Full',
                    'data' => null,
                ], 400);
            } 
        }else {
            return response([
                'message' => 'You cant book this class. Please check your deposit money or deposit packet class',
                'data' => null,
            ], 400);
        } 
    }

    public function getDataBooking(Request $request){
        // $booking = BookingClass::where('ID_MEMBER',$id)->first();
        $booking = DB::table('booking_kelas as bk')->select('bk.KODE_BOOKING_KELAS','k.NAMA_KELAS',DB::raw('DATE_FORMAT(bk.TANGGAL_JADWAL_HARIAN, "%d-%b-%Y %H:%i:%s") as TANGGAL_JADWAL_HARIAN'),DB::raw('DATE_FORMAT(bk.TANGGAL_MELAKUKAN_BOOKING, "%d-%b-%Y %H:%i:%s") as TANGGAL_MELAKUKAN_BOOKING'),DB::raw('DATE_FORMAT(bk.WAKTU_KONFIRMASI_PRESENSI_KELAS, "%d-%b-%Y %H:%i:%s") as WAKTU_KONFIRMASI_PRESENSI_KELAS'),'bk.STATUS_PRESENSI_KELAS')
        ->join('jadwal_harian as jh','bk.TANGGAL_JADWAL_HARIAN','jh.TANGGAL_JADWAL_HARIAN')
        ->join('jadwal_umum as ju','jh.ID_JADWAL_UMUM','ju.ID_JADWAL_UMUM')
        ->join('kelas as k','ju.ID_KELAS','k.ID_KELAS')
        ->where('ID_MEMBER',$request->ID_MEMBER)
        ->whereRaw('MONTHNAME(bk.TANGGAL_JADWAL_HARIAN) = ?',[$request->BULAN])
        ->whereRaw('YEAR(bk.TANGGAL_JADWAL_HARIAN) = ?',[$request->TAHUN])
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

    public function cancelBooking($id){
        $booking = BookingClass::where('KODE_BOOKING_KELAS',$id)->first();

        
        if($booking){
            if(Carbon::now()->format('Y-m-d') <= Carbon::parse($booking->TANGGAL_JADWAL_HARIAN)->subDays(1)->format('Y-m-d')){
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

    public function index_booking(Request $request){
        if($request->accepts('text/html')){
            $booking = BookingClass::orderBy('KODE_BOOKING_KELAS','desc')->where('STATUS_PRESENSI_KELAS',null)->paginate(20);
            $booking2 = BookingClass::orderBy('KODE_BOOKING_KELAS','desc')->where('STATUS_PRESENSI_KELAS','!=',null)->paginate(20);
            
            return view('presensi-booking-class/presensi-booking-class_view')->with([
                'user' => Auth::guard('pegawai')->user(),
                'presensies' => $booking,
                'presensies2' => $booking2
            ]);
        }
    }

    public function booking_receipt(Request $request,$id){
        if($request->accepts('text/html')){
            $booking_receipt_reguler = DB::table('booking_kelas as bk')
            ->select('bk.KODE_BOOKING_KELAS', 'm.SISA_DEPOSIT_MEMBER' ,'m.ID_MEMBER','ik.NAMA_INSTRUKTUR','m.NAMA_MEMBER','jh.ID_INSTRUKTUR','k.NAMA_KELAS','bk.TANGGAL_JADWAL_HARIAN','bk.TANGGAL_MELAKUKAN_BOOKING','bk.WAKTU_KONFIRMASI_PRESENSI_KELAS','bk.STATUS_PRESENSI_KELAS','bk.TARIF_KELAS')
            ->join('jadwal_harian as jh','bk.TANGGAL_JADWAL_HARIAN','jh.TANGGAL_JADWAL_HARIAN')
            ->join('jadwal_umum as ju','jh.ID_JADWAL_UMUM','ju.ID_JADWAL_UMUM')
            ->join('kelas as k','ju.ID_KELAS','k.ID_KELAS')
            ->join('member as m', 'bk.ID_MEMBER','m.ID_MEMBER')
            ->join('instruktur as ik','jh.ID_INSTRUKTUR','ik.ID_INSTRUKTUR')
            ->where('KODE_BOOKING_KELAS',$id)->first();

            $check = BookingClass::where('KODE_BOOKING_KELAS',$id)->first();
            $check2 = DailySchedule::where('TANGGAL_JADWAL_HARIAN',$check->TANGGAL_JADWAL_HARIAN)->first();
            $check3 = GeneralSchedule::where('ID_JADWAL_UMUM',$check2->ID_JADWAL_UMUM)->first();
            $booking_receipt_packet = MemberDepositClass::where('ID_MEMBER',$check->ID_MEMBER)->where('ID_KELAS',$check3->ID_KELAS)->first();

            return view('presensi-booking-class/presensi-receipt')->with([
                'user' => Auth::guard('pegawai')->user(),
                'presensies' => $booking_receipt_reguler,
                'presensies2' => $booking_receipt_packet,
            ]);
        }
    }

    public function index_api_schedule_presence(Request $request,$id){
        if($request->expectsjson()){
            $schedule_daily = DB::table('jadwal_harian as jh')->select('jh.TANGGAL_JADWAL_HARIAN','i.ID_INSTRUKTUR','i.NAMA_INSTRUKTUR','k.NAMA_KELAS','ju.ID_KELAS','jh.KETERANGAN_JADWAL_HARIAN','ju.HARI_JADWAL', 'k.TARIF')
            ->join('instruktur as i','jh.ID_INSTRUKTUR','i.ID_INSTRUKTUR')
            ->join('jadwal_umum as ju','jh.ID_JADWAL_UMUM','ju.ID_JADWAL_UMUM')
            ->join('kelas as k','ju.ID_KELAS','k.ID_KELAS')
            ->where('jh.TANGGAL_JADWAL_HARIAN','>=',Carbon::now()->format('Y-m-d'))->where('jh.TANGGAL_JADWAL_HARIAN','<',Carbon::now()->addDays(1)->format('Y-m-d'))->where('jh.KETERANGAN_JADWAL_HARIAN','!=','Libur')->where('jh.ID_INSTRUKTUR',$id)
            ->orderby('jh.TANGGAL_JADWAL_HARIAN','asc')->get();
            if($schedule_daily){
                return response([
                    'message' => 'Successfully get data schedule',
                    'data' => $schedule_daily,
                ],200);
            }
            return response([
                'message' => 'Data schedule not found',
                'data' => null,
            ],400);
        }
    }

    public function index_api_history_presence(Request $request, $id){
        if($request->expectsJson()){
            $booking = DB::table('booking_kelas as bk')->select('bk.KODE_BOOKING_KELAS','m.NAMA_MEMBER','m.ID_MEMBER', 'k.NAMA_KELAS','bk.TANGGAL_JADWAL_HARIAN','bk.TANGGAL_MELAKUKAN_BOOKING','bk.WAKTU_KONFIRMASI_PRESENSI_KELAS','bk.STATUS_PRESENSI_KELAS')
            ->join('jadwal_harian as jh','bk.TANGGAL_JADWAL_HARIAN','jh.TANGGAL_JADWAL_HARIAN')
            ->join('jadwal_umum as ju','jh.ID_JADWAL_UMUM','ju.ID_JADWAL_UMUM')
            ->join('kelas as k','ju.ID_KELAS','k.ID_KELAS')
            ->join('member as m','bk.ID_MEMBER','m.ID_MEMBER')
            ->where('jh.TANGGAL_JADWAL_HARIAN',$id)->get();
            if($booking){
                return response([
                    'message' => 'Successfully get data presence',
                    'data' => $booking,
                ],200);
            }
            return response([
                'message' => 'Failed get data presence',
                'data' => null,
            ],400);
        }
    }

    public function update_transaction(Request $request){
        if($request->expectsJson()){
            $data = $request->only('KODE_BOOKING_KELAS','STATUS_PRESENSI_KELAS');
            $validate = Validator::make($data,[
                'KODE_BOOKING_KELAS' => ['required'],
                'STATUS_PRESENSI_KELAS' => ['required'],
            ],[
                'KODE_BOOKING_KELAS.required'=>'Kode Booking field is empty',
                'STATUS_PRESENSI_KELAS.required'=>'Status field is empty'
            ]);
    
            if($validate->fails()) {
                return response(['success' => false,'message' => $validate->errors()],400);   
            }
            
            $booking_class = BookingClass::where('KODE_BOOKING_KELAS',$request->KODE_BOOKING_KELAS)->first();

            if($booking_class->STATUS_PRESENSI_KELAS != null){
                return response([
                    'message' => 'You have been confirm presence this member',
                    'data' => null,
                ],400);
            }
            
            if($booking_class){
                $presence = InstructorAttendance::where('TANGGAL_MENGAJAR',$booking_class->TANGGAL_JADWAL_HARIAN)->first();
                if($presence){
                    if($presence->JAM_MULAI != null){
                        if($presence->JAM_SELESAI != null){
                            return response([
                                'message' => 'Class has been finished',
                                'data' => null,
                            ],400);
                        }
                        if($booking_class->TARIF_KELAS == 1){
                            $daily_schedule = DailySchedule::where('TANGGAL_JADWAL_HARIAN',$booking_class->TANGGAL_JADWAL_HARIAN)->first();
                            $general_schedule = GeneralSchedule::where('ID_JADWAL_UMUM',$daily_schedule->ID_JADWAL_UMUM)->first();
                            $member_deposit = MemberDepositClass::where('ID_MEMBER',$booking_class->ID_MEMBER)->where('ID_KELAS',$general_schedule->ID_KELAS)->first();
                            if($member_deposit){
                                $member_deposit->DEPO_SISA -= $booking_class->TARIF_KELAS;
                                $member_deposit->update();
                                $booking_class->STATUS_PRESENSI_KELAS = $request->STATUS_PRESENSI_KELAS;
                                $booking_class->WAKTU_KONFIRMASI_PRESENSI_KELAS = Carbon::now();
                                $booking_class->update();
                                return response([
                                    'message' => 'Successfully update member deposit class',
                                    'data' => $member_deposit,
                                ],200);
                            }else {
                                return response([
                                    'message' => 'Failed get data member deposit',
                                    'data' => null,
                                ],400);
                            }
                        }else{
                            $member = Member::where('ID_MEMBER',$booking_class->ID_MEMBER)->first();
                            $member->SISA_DEPOSIT_MEMBER -= $booking_class->TARIF_KELAS;
                            $member->update();
                            $booking_class->STATUS_PRESENSI_KELAS =  $request->STATUS_PRESENSI_KELAS;
                            $booking_class->WAKTU_KONFIRMASI_PRESENSI_KELAS = Carbon::now();
                            $booking_class->update();
                            return response([
                                'message' => 'Successfully update deposit money member',
                                'data' => $member,
                            ],200);
                        }
                    }else{
                        return response([
                            'message' => 'Instructor must confirm attendance by manajer operasional first',
                            'data' => null,
                        ],400);
                    }
                }else{
                    return response([
                        'message' => 'Instructor must confirm attendance by manajer operasional first',
                        'data' => null,
                    ],400);
                } 
            }else {
                return response([
                    'message' => 'Failed get data booking class',
                    'data' => null,
                ],400);
            }
        }
    }

    public function history_instructor(Request $request){
        if($request->expectsjson()){
            $schedule_daily = DB::table('jadwal_harian as jh')->select(DB::raw('DATE_FORMAT(jh.TANGGAL_JADWAL_HARIAN, "%d-%b-%Y %H:%i:%s") as TANGGAL_JADWAL_HARIAN'),'i.ID_INSTRUKTUR','i.NAMA_INSTRUKTUR','k.NAMA_KELAS','ju.ID_KELAS','jh.KETERANGAN_JADWAL_HARIAN','ju.HARI_JADWAL', 'k.TARIF')
            ->join('instruktur as i','jh.ID_INSTRUKTUR','i.ID_INSTRUKTUR')
            ->join('jadwal_umum as ju','jh.ID_JADWAL_UMUM','ju.ID_JADWAL_UMUM')
            ->join('kelas as k','ju.ID_KELAS','k.ID_KELAS')
            ->where('jh.ID_INSTRUKTUR',$request->ID_INSTRUKTUR)
            ->whereRaw('MONTHNAME(jh.TANGGAL_JADWAL_HARIAN) = ?',[$request->BULAN])
            ->whereRaw('YEAR(jh.TANGGAL_JADWAL_HARIAN) = ?',[$request->TAHUN])
            ->orderby('jh.TANGGAL_JADWAL_HARIAN','asc')->get();
            if($schedule_daily){
                return response([
                    'message' => 'Successfully get data schedule',
                    'data' => $schedule_daily,
                ],200);
            }
            return response([
                'message' => 'Data schedule not found',
                'data' => null,
            ],400);
        }
    }
        
}