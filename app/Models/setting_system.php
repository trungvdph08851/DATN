<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting_system extends Model
{
    use HasFactory;
    protected $table = "setting_system";
    public $fillable = [
        'name_system', 'contact_information', 'address', 'logo', 'operating_hours','google_map','hotline','email_contact','social_fb','social_yt','social_instagram'
    ];
}
//quang
