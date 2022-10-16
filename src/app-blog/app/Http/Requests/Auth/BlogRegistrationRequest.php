<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class BlogRegistrationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                 => 'required|min:3',
            'email'                     => 'required|email',
            'password'                  => 'required|min:8',
            'password_confirmation'     => 'same:password',
        ];
    }
}
