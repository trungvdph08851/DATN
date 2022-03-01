<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking_services extends Model
{
    use HasFactory;
    protected $table = "booking_services";
    public $fillable = [
        'services_id', 'booking_id', 'start_date', 'end_date', 'status', 'doctor_id'
    ];
    public function booking(){
        return $this->belongsTo(booking::class,'booking_id','id');
    }
    public function services(){
        return $this->belongsTo(Services::class,'services_id','id');
    }
    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id','id');
    }
    public function bookingSchedule(){
        return $this->hasMany(booking_schedule::class,'booking_services_id','id');
    }
}
