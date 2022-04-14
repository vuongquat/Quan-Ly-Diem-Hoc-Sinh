<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
             'first_name' => 'required|max:10',
             'last_name' => 'required|max:20|min:2',
             'phone_number' => 'required|max:15|min:9',
             'address' => 'required',
             'email' => 'required|email|unique:teachers,email|unique:users,email,'.$this->id,
             'date_of_birth'=>'required'

        ];
    }
    public function messages()
{
    return [
        'first_name.required' => 'Bạn chưa nhập tên!',
        'first_name.max' => 'Độ dài tối đa 10 chữ cái!',
        'last_name.required' => 'Bạn chưa nhập họ!',
        'last_name.max' => 'Độ dài tối đa 20 chữ cái!',
        'last_name.min' => 'Độ dài tối thiểu 2 chữ cái!',
        'phone_number.required' => 'Bạn chưa nhập số điện thoại!',
        'phone_number.max' => 'Độ dài tối đa 15 số!',
        'phone_number.min' => 'Độ dài tối thiểu 9 số!',
        'address.required' => 'Bạn chưa nhập địa chỉ!',
        'email.required' => 'Bạn chưa nhập email!',
        'email.email' => 'Không đúng định dạng email!',
        'email.unique' => 'Email này đã tồn tại. Vui lòng nhập email khác',
        'date_of_birth.required' => 'Bạn chưa nhập ngày sinh!',
    ];
}
}
