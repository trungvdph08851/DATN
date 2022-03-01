<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServicesRequest extends FormRequest
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
        $image = '';
        $dataRequest = $this->request->all();

        // edit không cần thay ảnh
        if(!empty($dataRequest['id'])){
            $image = 'mimes:jpeg,jpg,png';
        }else{
            $image = 'required|mimes:jpeg,jpg,png';
        }

        return [
            'name' => [
                'required',
                'min:5',
                Rule::unique('services')->ignore($this->id)
            ],
            'title' => 'required',
            'image' => $image,
            'description' => 'required',
            'price' => 'required',
            'time' => 'required',
        ];
        return $rule;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên dịch vụ !',
            'name.min' => 'Vui lòng nhập thiểu :min ký tự !',
            'name.unique' => 'Tên dịch vụ đã tồn tại !',
            'title.required' => 'Vui lòng nhập tiêu đề !',
            'price.required' => 'Vui lòng nhập giá dịch vụ !',
            'description.required' => 'Vui lòng nhập thông tin chi tiết !',
            'image.required' => 'Vui lòng chọn ảnh !',
            'image.mimes' => 'Vui lòng chọn ảnh theo định dạng (jgp/ jpeg/ png) !',
            'time.required' => 'Vui lòng nhập thời gian !',
        ];
    }

}
//quang
