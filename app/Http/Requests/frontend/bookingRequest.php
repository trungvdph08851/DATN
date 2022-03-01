<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class bookingRequest extends FormRequest
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
            'note' => 'required',
        ];
    }
    public function messages(){
        return [
            'required' => ':attribute không được để trống',
            'numeric' => 'số điện thoại không đúng định dạng',
        ];
    }
    public function attributes(){
        return [
            'name' => 'Họ tên',
            'phone_number' => 'Số điện thoại',
            'note' => 'Ghi chú tình trạng bệnh',
            'services_id' => 'Dịch vụ khám',
        ];
    }
}
//quang
