<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class DailySchedule extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'jadwal_harian';
    protected $primaryKey = 'TANGGAL_JADWAL_HARIAN';
    protected $keyType = 'datetime';

    protected $fillable = [
        'TANGGAL_JADWAL_HARIAN',
        'ID_INSTRUKTUR',
        'ID_JADWAL_UMUM',
        'KETERANGAN_JADWAL_HARIAN',
        'expired_at',
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

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }
    
    public function schedule()
    {
        return $this->belongsTo('App\Models\GeneralSchedule','ID_JADWAL_UMUM');
    }

    public function instructor()
    {
        return $this->belongsTo('App\Models\Instructor','ID_INSTRUKTUR');
    }
}