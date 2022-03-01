<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UpdateArticle;
class updateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required','min:20','max:100',new UpdateArticle()],
            'description' => 'required|min:20|max:100',
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'url'=>['required', new UpdateArticle()],
            'content'=>'required',
            'cate_id'=>'required'
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'title.min' => 'Tiêu đề quá ngắn',
            'title.max' => 'Tiêu đề quá dài',
            'url.unique' => 'Đường dẫn đã tồn tại',
            'description.min' => 'Mô tả quá ngắn',
            'description.max' => 'Mô tả quá dài',
            'avatar.image' => 'vui long chỉ chọn ảnh mục này',
            'avatar.mimes' => 'ảnh định dạng jpeg, png, jpg',
            'avatar.max' => 'dung lượng ảnh nhỏ hơn 2Mb'
        ];
    }
    public function attributes(){
        return [
            'title' => 'Tiêu đề bài viết',
            'description' => 'Mô tả ngắn',
            'avatar' => 'Ảnh đại diện',
            'url' => 'Đường dẫn bài viết',
            'content' => 'Nội dung bài viết',
            'cate_id' => 'Danh mục bài viết',
        ];
    }
}
