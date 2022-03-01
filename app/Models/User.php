<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'phone_number',
        'role'
    ];
    public function services(){
        return $this->belongsToMany(Services::class,'doctor_services','doctor_id','service_id');
    }
    public function doctorServices(){
        return $this->hasMany(booking_services::class, 'doctor_id', 'id');
    }
    public function doctorSchedule(){
        return $this->hasMany(booking_schedule::class, 'doctor_id', 'id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
