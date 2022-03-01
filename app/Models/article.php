<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryArticle;
class article extends Model
{
    use HasFactory;
    protected $table = 'article';
    protected $fillable = ['title','description','url','avatar','content','cate_id','single_page', 'status'];
    public function CategoryArticle(){
        return $this->belongsTo(CategoryArticle::class, 'cate_id','id');
    }
}
//quang
