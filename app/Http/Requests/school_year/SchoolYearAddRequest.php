<?php

namespace App\Http\Requests\school_year;

use Illuminate\Foundation\Http\FormRequest;

class SchoolYearAddRequest extends FormRequest
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
             'start_year' => 'required|max:4|min:4|gt:2000|lt:2050',
        ];
    }
    public function messages()
{
    return [
        'start_year.required' => 'Bạn chưa nhập năm bắt đầu',
        'start_year.max' => 'Độ dài phải có 4 chữ số',
        'start_year.min' => 'Độ dài phải có 4 chữ số',
        'start_year.gt' => 'Năm học phải lớn hơn 2000',
        'start_year.lt' => 'Năm học phải nhỏ hơn 2050',
    ];
}
}
