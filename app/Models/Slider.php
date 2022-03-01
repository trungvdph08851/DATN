<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'slider_setting';
    protected $fillable = ['title', 'description', 'image','url_slug','status'];
}
//quang
