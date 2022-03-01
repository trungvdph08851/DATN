<?php

namespace App\Models;

use App\Models\CategoryArticle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctor';
    protected $fillable = ['name','avatar','position','description','certificate'];

}
//quang
