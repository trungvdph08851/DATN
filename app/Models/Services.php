<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $table = "services";
    public $fillable = [
        'name', 'title', 'image', 'description', 'price', 'time', 'status'
    ];
    public function bookingServices(){
        return $this->hasMany(booking_services::class,'services_id','id');
    }
}
