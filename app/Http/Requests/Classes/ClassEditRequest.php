<?php

namespace App\Http\Requests\Classes;

use Illuminate\Foundation\Http\FormRequest;

class ClassEditRequest extends FormRequest
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
            'class_grade' => 'required|unique:class_grades,class_grade,'.$this->id.'|max:10|min:4',
            'id_grade'=> 'required'
        ];
    }

    public function messages()
{
    return [
        'class_grade.required' => 'Bạn cần phải nhập tên lớp!',
        'class_grade.unique' => 'Lớp đã tồn tại!',
        'class_grade.max' => 'Tên lớp quá dài!',
        'class_grade.min' => 'Tên lớp phải có tối thiểu 4 kí tự!',
        'id_grade.required' => 'Bạn chưa chọn khối!',
    ];
}
}
