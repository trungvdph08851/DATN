<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_services extends Model
{
    use HasFactory;
    protected $table = "doctor_services";
    public $fillable = [
        'services_id', 'doctor_id'
    ];
    
}
