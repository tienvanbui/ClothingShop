<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeUserRequest extends FormRequest
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
            'name' =>'bail|alpha|required|max:30|min:10',
            'email' =>'required|email|bail',
            'username'=>'required|alpha_dash|max:30|min:10|bail',
            'avatar'=>'required',
            'user_id'=>'required|numeric|bail',
            'phoneNumber'=>'required|bail',
            'address'=>'required|string|bail'
        ];
    }
}
