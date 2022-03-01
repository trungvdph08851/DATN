<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\article;
class CategoryArticle extends Model
{
    use HasFactory;
    protected $table = 'category_article';
    protected $fillable = ['name','url_name'];
    public function article(){
        return $this->hasMany(article::class, 'cate_id', 'id');
    }
}
//quang
