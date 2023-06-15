<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class InstructorPermission extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'izin_instruktur';
    protected $primaryKey = 'ID_IZIN_INSTRUKTUR';

    protected $fillable = [
        'ID_INSTRUKTUR',
        'NAMA_INSTRUKTUR_PENGGANTI',
        'TANGGAL_IZIN_INSTRUKTUR',
        'KETERANGAN_IZIN',
        'TANGGAL_MELAKUKAN_IZIN',
        'STATUS_IZIN',
        'TANGGAL_KONFIRMASI_IZIN',
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
    
}