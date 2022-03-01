<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Slider;
class CheckTitleSlideUpdate implements Rule
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
        $result = Slider::find($id);
        $title = $result->title;
        if( $title === $value ){
            return true;
        }
        $count = Slider::where('title' , $value)->count();
        if($count > 0){
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
        return 'The validation error message.';
    }
}

