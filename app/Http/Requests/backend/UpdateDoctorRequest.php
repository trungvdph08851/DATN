<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckPhoneDoctor;
class UpdateDoctorRequest extends FormRequest
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
            'email' => 'required',
            'address' => 'required',
            'phone_number' => [
                'required',
                'numeric',
                'digits:10',
                new CheckPhoneDoctor(),
            ],
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'phone_number.numeric' => 'số điện thoại không đúng định dạng',
            'phone_number.digits' => 'số điện thoại bao gồm 10 chữ số 0-9',

        ];
    }
    public function attributes(){
        return [
            'name' => 'Họ tên bác sĩ',
            'email' => 'Địa chỉ email',
            'phone_number' => 'Số điẹn thoại',
            'address' => 'Đại chỉ bác sĩ',
        ];
    }
}
//quang
