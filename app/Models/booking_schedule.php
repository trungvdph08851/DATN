<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking_schedule extends Model
{
    use HasFactory;
    protected $table = "booking_schedule";
    public $fillable = [
        'booking_services_id', 'booking_id', 'doctor_id', 'start_date' ,'end_date','note', 'status'
    ];
    public function booking(){
        return $this->belongsTo(booking::class,'booking_id','id');
    }
    public function bookingServices(){
        return $this->belongsTo(booking_services::class,'booking_services_id','id');
    }
    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id','id');
    }

}
