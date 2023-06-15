<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;

class Member extends Authenticatable
{
    use HasApiTokens,HasFactory,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'member';
    protected $primaryKey = 'ID_MEMBER';
    protected $keyType = 'string';
    // public $incrementing = false;
    protected $guard = 'member';

    protected $fillable = [
        'NAMA_MEMBER',
        'ALAMAT_MEMBER',
        'TANGGAL_LAHIR_MEMBER',
        'TELEPON_MEMBER',
        'USIA_MEMBER',
        'JENIS_KELAMIN_MEMBER',
        'MASA_AKTIVASI',
        'SISA_DEPOSIT_MEMBER',
        'EMAIL_MEMBER',
        'password',
        'expired_deactive',
        'expired_reset_class'
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