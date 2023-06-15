<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;

class Instructor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'instruktur';
    protected $primaryKey = 'ID_INSTRUKTUR';
    protected $guard = 'instructor';

    protected $fillable = [
        'NAMA_INSTRUKTUR',
        'ALAMAT_INSTRUKTUR',
        'TELEPON_INSTRUKTUR',
        'UMUR_INSTRUKTUR',
        'JENIS_KELAMIN_INSTRUKTUR',
        'TANGGAL_LAHIR_INSTRUKTUR',
        'EMAIL_INSTRUKTUR',
        'password',
        'JUMLAH_TERLAMBAT',
        'expired_reset_terlambat',
    ];

    protected $hidden = [
        'remember_token',
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