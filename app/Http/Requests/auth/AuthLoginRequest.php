<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
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
            'user' => 'required',
            'password'=> 'required'
        ];
    }
    public function messages()
{
    return [
        'user.required' => 'Bạn chưa nhập tài khoản',
        'password.required'=>'Bạn chưa nhập mật khẩu'
    ];
}
}
