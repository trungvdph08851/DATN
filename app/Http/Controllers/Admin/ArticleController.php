<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\article;
use App\Models\CategoryArticle;
use App\Http\Requests\backend\articleRequest;
use App\Http\Requests\backend\updateArticleRequest;
use Illuminate\Support\Facades\File;
class ArticleController extends Controller
{
    public function index(){
        $article = article::all();
        $article->load(['CategoryArticle']);
        return view('backend.article.index',['articles'=>$article]);
    }
    public function add(){
        $categories = CategoryArticle::all();
        return view('backend.article.add',['categories'=>$categories]);
    }
    public function store(articleRequest $request){
        $data = $request->all();
        if($request->file()){
            $avatar = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('img'), $avatar);
            $data['avatar'] = $avatar;
        }
        $data['status'] = 1;
        article::create($data);
        return redirect()->route('article.index')->with('success', 'Tạo bài viết thành công');
    }
    public function edit($id){
        $categories = CategoryArticle::all();
        $article = article::find($id);
        return view('backend.article.edit',['categories'=>$categories,'article'=>$article]);
    }
    public function editSave($id, updateArticleRequest $request){
        $data = article::find($id);
        $update = $request->all();
        if($request->file()){
            $avatar = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('img'), $avatar);
            $update['avatar'] = $avatar;
        }
        $data->update($update);
        return redirect()->route('article.index')->with('success', 'Sửa bài viết thành công');
    }
    public function deleteArticle($id){
        if($id == 9){
            return redirect()->back()->with('toastrWarning', 'Không thể xóa bài viết này !');
        }
        $data = article::find($id);
        $data->delete();
        if(File::exists($data->avatar)) {
            File::delete($data->avatar);
        }
        return redirect()->route('article.index')->with('success', 'Xóa thành công');
    }
    public function changeStatus(Request $request){
        $article = article::find($request->id);
        $article->status = $request->status;
        $article->save();
        return response()->json(['success'=>'cập nhật thành công']);
    }
}
//quang
//1
