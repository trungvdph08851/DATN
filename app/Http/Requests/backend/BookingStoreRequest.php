<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
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
            'phone_number' => 'required|numeric',
            'services_id' => 'required',

        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống !',
            'numeric' => 'số điện thoại không đúng định dạng !',
        ];
    }
    public function attributes(){
        return [
            'name' => 'Họ tên',
            'phone_number' => 'Số điện thoại',
            'services_id' => 'Dịch vụ khám',
        ];
    }
}
//quang
