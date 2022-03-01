<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryArticle;
use App\Models\article;
class CategoryArticleController extends Controller
{
    public function index(){
        $Categories = CategoryArticle::all();
        return view('backend.category.index',['Categories'=>$Categories]);
    }
    public function add(){
        return view('backend.category.add');
    }
    public function store(Request $request){
        $category = new CategoryArticle();
        $category->fill($request->all());
        $category->save();
        return redirect()->route('category.index')->with('success', 'Them bài viết thành công');
    }
    public function edit($id)
    {
        $category = CategoryArticle::find($id);
        return view('backend.category.edit',['category'=>$category]);
    }
    public function editSave($id, Request $request){
        $category = CategoryArticle::find($id);
        $category->fill($request->all());
        $category->save();
        return redirect()->route('category.index')->with('success', 'Sửa bài viết thành công');
    }
    public function deletecate($id){
        if($id == 1){
            return redirect()->back()->with('toastrWarning','Không thể xóa chuyên mục này');
        }
        $category = CategoryArticle::find($id);
        $category->delete();
        $articles = article::where('cate_id', $id)->delete();
        return redirect()->route('category.index')->with('success', 'xoa bài viết thành công');
    }
}
//quang
