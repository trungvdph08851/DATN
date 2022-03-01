<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorRequest extends FormRequest
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
        $avatar = '';
        $dataRequest = $this->request->all();

        // edit không cần thay ảnh
        if(!empty($dataRequest['id'])){
            $avatar = 'mimes:jpeg,jpg,png';
        }else{
            $avatar = 'required|mimes:jpeg,jpg,png';
        }

        return [
            'name' => [
                'required',
                'min:5',
                Rule::unique('doctor')->ignore($this->id)
            ],
            'avatar' => $avatar,
            'position' => 'required',
            'description' => 'required',
        ];
        return $rule;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên bác sĩ !',
            'name.min' => 'Vui lòng nhập thiểu :min ký tự !',
            'name.unique' => 'Tên bác đã tồn tại !',
            'position.required' => 'Vui lòng nhập chức vụ bác sĩ !',
            'description.required' => 'Vui lòng nhập thông tin chi tiết !',
            'avatar.required' => 'Vui lòng chọn ảnh !',
            'avatar.mimes' => 'Vui lòng chọn ảnh theo định dạng (jgp/ jpeg/ png) !',
        ];
    }

}
//quang
