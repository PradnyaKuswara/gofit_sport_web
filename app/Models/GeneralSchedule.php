<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class GeneralSchedule extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'jadwal_umum';
    protected $primaryKey = 'ID_JADWAL_UMUM';
    // public $incrementing = false;

    protected $fillable = [
        'ID_KELAS',
        'ID_INSTRUKTUR',
        'HARI_JADWAL',
        'WAKTU_JADWAL',
        'TANGGAL_JADWAL'
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

    public function instructor()
    {
        return $this->belongsTo('App\Models\Instructor','ID_INSTRUKTUR');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas','ID_KELAS');
    }
    
}