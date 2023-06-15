<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('cekUserLogin');
    }
    
    public function index()
    {
        for($x = 0; $x < 12 ; $x++){
            $report_income_deposit[] = DB::select(
                'SELECT MONTHNAME(t.TANGGAL_DEPOSIT_KELAS) as bulan, SUM(t.jumlah_pembayaran) AS total_income_deposit FROM 
                (SELECT jumlah_pembayaran, tanggal_deposit_kelas FROM transaksi_deposit_kelas 
                UNION ALL 
                SELECT total_deposit, tanggal_deposit_uang FROM transaksi_deposit_uang) t WHERE YEAR(t.TANGGAL_DEPOSIT_KELAS) = '.Carbon::now()->format('Y').' AND MONTH(t.TANGGAL_DEPOSIT_KELAS) ='.$x.' +1 GROUP BY bulan');

            $report_income_activaton[] = DB::select(
                'SELECT MONTHNAME(TANGGAL_TRANSAKSI_AKTIVASI) as bulan, SUM(BIAYA_AKTIVASI) as total_income_activation 
                FROM transaksi_aktivasi 
                WHERE YEAR(TANGGAL_TRANSAKSI_AKTIVASI) = '.Carbon::now()->format('Y').' AND MONTH(TANGGAL_TRANSAKSI_AKTIVASI) ='.$x.' + 1 GROUP BY bulan');
                
            $report_total[] = DB::select(
                'SELECT MONTHNAME(t.TANGGAL_DEPOSIT_KELAS) as bulan, SUM(t.jumlah_pembayaran) AS total_income FROM 
                (SELECT jumlah_pembayaran, tanggal_deposit_kelas FROM transaksi_deposit_kelas 
                UNION ALL 
                SELECT total_deposit, tanggal_deposit_uang FROM transaksi_deposit_uang
                UNION ALL
                SELECT biaya_aktivasi, tanggal_transaksi_aktivasi FROM transaksi_aktivasi ) t WHERE YEAR(t.TANGGAL_DEPOSIT_KELAS) = '.Carbon::now()->format('Y').' AND MONTH(t.TANGGAL_DEPOSIT_KELAS) ='.$x.' +1 GROUP BY bulan'
            );
        }

        $collection = collect([
            $report_total
        ]);

        $collapsed = $collection->collapse();
        $collapsed2 = $collapsed->collapse();

        $temp_keys =['January','February','March','April','May','June','July','August','September','October','November','December'];
        $temp_value = [0,0,0,0,0,0,0,0,0,0,0,0];
        $keys = [];
        $value = [];

        for($i = 0; $i < 12; $i++){
            if($collapsed[$i]){
                $keys[] = $collapsed[$i][0]->bulan;
                $value[] = $collapsed[$i][0]->total_income;
            }else{
                $keys[] = $temp_keys[$i];
                $value[] = $temp_value[$i];
            }
        }
        
        return view('layouts/main_dashboard')->with([
            'user' => Auth::guard('pegawai')->user(),
            'data_depo_class' => $report_income_deposit,
                'data_activation' => $report_income_activaton,
                'data_total_income' => $report_total,
                'year'=> Carbon::now()->format('Y'),
                'report_keys'=> $keys,
                'report_value' => $value
        ]);
    }
}