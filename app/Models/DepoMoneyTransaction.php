<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class DepoMoneyTransaction extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'transaksi_deposit_uang';
    protected $primaryKey = 'ID_TRANSAKSI_DEPOSIT_UANG';
    protected $keyType = 'string';

    protected $fillable = [
        'ID_PROMO',
        'ID_MEMBER',
        'ID_PEGAWAI',
        'JUMLAH_DEPOSIT',
        'BONUS_DEPOSIT',
        'SISA_DEPOSIT',
        'TOTAL_DEPOSIT',
        'TANGGAL_DEPOSIT_UANG',
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

    
}