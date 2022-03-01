<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $table = "booking";
    public $fillable = [
        'name', 'phone_number', 'address' ,'price','cmnd' , 'note', 'status', 'booking_code'
    ];
    
    public function bookingSchedule(){
        return $this->hasMany(booking_schedule::class,'booking_id','id');
    }
    public function bookingServices(){
        return $this->hasMany(booking_services::class,'booking_id','id');
    }

    public function services(){
        return $this->belongsToMany(Services::class,'booking_services','booking_id','services_id');
    }
}
