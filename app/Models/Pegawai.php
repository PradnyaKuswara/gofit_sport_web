<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
// use Illuminate\Database\Eloquent\Model;

class Pegawai extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'pegawai';
    protected $primaryKey = 'ID_PEGAWAI';
    protected $guard = 'pegawai';

    protected $fillable = [
        'NAMA_PEGAWAI',
        'ALAMAT_PEGAWAI',
        'EMAIL_PEGAWAI',
        'password',
        'ROLE_PEGAWAI',
        'USIA_PEGAWAI',
        'JENIS_KELAMIN_PEGAWAI',
        'TANGGAL_LAHIR_PEGAWAI',
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