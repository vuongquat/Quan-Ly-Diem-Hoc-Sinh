<?php

namespace App\Http\Requests\student;

use Illuminate\Foundation\Http\FormRequest;

class StudentEditRequest extends FormRequest
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
             'address' => 'required',
             'id_class' => 'required',
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
        'address.required' => 'Bạn chưa nhập địa chỉ!',
        'date_of_birth.required' => 'Bạn chưa nhập ngày sinh!',
        'id_class.required' => 'Bạn chưa chọn lớp!',
    ];
}
}
