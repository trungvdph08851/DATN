<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\article;
class UpdateArticle implements Rule
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
        $result = article::find($id);
        $title = $result->title;
        $url = $result->url;
        if( $title === $value ){
            return true;
        }
        if($url === $value){
            return true;
        }
        $count = article::where($attribute , $value)->count();
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
        return ':attribute Đã tồn tại';
    }
}
