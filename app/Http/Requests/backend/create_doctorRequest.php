<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class create_doctorRequest extends FormRequest
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
            'name' => 'required',
            'phone_number' => 'required|numeric|unique:doctor,phone_number',
            'email' => 'required',
            'address' => 'required',
            'avatar' => 'required'
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'phone_number.numeric' => 'số điện thoại không đúng định dạng',
            'phone_number.unique' => 'Số điện thoại đã tồn tại',
        ];
    }
    public function attributes(){
        return [
            'name' => 'Họ tên bác sĩ',
            'email' => 'Địa chỉ email',
            'phone_number' => 'Số điẹn thoại',
            'address' => 'Đại chỉ bác sĩ',
            'avatar' => 'Ảnh đại diện'
        ];
    }
}
//quang
