<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Promo extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'promo';
    protected $primaryKey = 'ID_PROMO';

    protected $fillable = [
        'NAMA_PROMO',
        'TANGGAL_MULAI_PROMO',
        'TANGGAL_BATAS_PROMO',
        'JENIS_PROMO',
        'KETERANGAN_PROMO',
        'MINIMAL_PEMBELIAN',
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

    
}