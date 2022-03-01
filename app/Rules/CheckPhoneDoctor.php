<?php

namespace App\Rules;
use App\Models\Doctor;
use Illuminate\Contracts\Validation\Rule;
class CheckPhoneDoctor implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $id = request()->id;
        $result = Doctor::find($id);
        $phone = $result->phone_number;
        if( $phone === $value ){
            return true;
        }
        $countCate = Doctor::where('phone_number' , $value)->count();
        if($countCate > 0){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Số điện thoại đã có trong hệ thống';
    }
}
//quang
