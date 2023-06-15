<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class DepoClassTransaction extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'transaksi_deposit_kelas';
    protected $primaryKey = 'ID_TRANSAKSI_PAKET';
    protected $keyType = 'string';

    protected $fillable = [
        'ID_MEMBER',
        'ID_PROMO',
        'ID_PEGAWAI',
        'ID_KELAS',
        'JUMLAH_DEPOSIT_KELAS',
        'TANGGAL_DEPOSIT_KELAS',
        'BONUS_DEPOSIT_KELAS',
        'TOTAL_DEPOSIT_KELAS',
        'JUMLAH_PEMBAYARAN',
        'MASA_BERLAKU_KELAS',
        'KEMBALIAN'
    ];

    public function getCreatedAtAttribute() {
        if(!is_null($this->attributes['created_at'])) {
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdateAtAtrribute() {
        if(!is_null($this->attributes['update_at'])) {
            return Carbon::parse($this->attributes['update_at'])->format('Y-m-d H:i:s');
        }
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member','ID_MEMBER');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai','ID_PEGAWAI');
    }

    public function promot()
    {
        return $this->belongsTo('App\Models\Promo','ID_PROMO');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas','ID_KELAS');
    }
}