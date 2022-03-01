<?php
namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckTitleSlideUpdate;
class SliderUpdateRequest extends FormRequest
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
            'description' => 'required',
            'url_slug'=>'required',
            'title'=>[
                'required',
                'min:15',
                'max:50',
                new CheckTitleSlideUpdate()
            ]
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'title.min' => 'Tiêu đề tối thiểu 15 ký tự',
            'title.max' => 'Tiêu đề tối đa 50 ký tự'
        ];
    }
    public function attributes(){
        return [
            'title' => 'Tiêu đề bài viết',
            'description' => 'Mô tả ngắn',
            'image' => 'Ảnh đại diện',
            'url_slug' => 'Đường dẫn ảnh',
        ];
    }
}

