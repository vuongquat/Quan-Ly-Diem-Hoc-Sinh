<?php

namespace App\Http\Requests\transcript;

use Illuminate\Foundation\Http\FormRequest;

class TranscriptEditRequest extends FormRequest
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
            'id_semester' => 'required',
            'id_school_year' => 'required',
            'gpa_math' => 'required|gte:0|lte:10',
            'gpa_literature' => 'required|gte:0|lte:10',
            'gpa_english' => 'required|gte:0|lte:10',
            'gpa_physics' => 'required|gte:0|lte:10',
            'gpa_chemistry' => 'required|gte:0|lte:10',
            'gpa_biology' => 'required|gte:0|lte:10',
            'gpa_history' => 'required|gte:0|lte:10',
            'gpa_geography' => 'required|gte:0|lte:10',
            'gpa_technology' => 'required|gte:0|lte:10',
            'gpa_informatics' => 'required|gte:0|lte:10',
            'gpa_civic_education' => 'required|gte:0|lte:10',
            'gpa_national_defense_education' => 'required|gte:0|lte:10',
            'gpa_physical_education' => 'required',
        ];
    }
     public function messages()
{
    return [
        'id_semester.required'=>'Bạn chưa chọn học kỳ',
        'id_school_year.required'=>'Bạn chưa chọn năm học',
        'gpa_math.required' => 'Bạn chưa nhập điểm toán',
        'gpa_math.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_math.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_literature.required' => 'Bạn chưa nhập điểm văn',
        'gpa_literature.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_literature.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_english.required' => 'Bạn chưa nhập điểm tiếng anh',
        'gpa_english.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_english.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_english.required' => 'Bạn chưa nhập điểm tiếng anh',
        'gpa_english.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_english.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_physics.required' => 'Bạn chưa nhập điểm vật lý',
        'gpa_physics.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_physics.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_chemistry.required' => 'Bạn chưa nhập điểm hóa',
        'gpa_chemistry.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_chemistry.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_biology.required' => 'Bạn chưa nhập điểm sinh',
        'gpa_biology.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_biology.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_history.required' => 'Bạn chưa nhập điểm lịch sử',
        'gpa_history.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_history.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_geography.required' => 'Bạn chưa nhập điểm địa lý',
        'gpa_geography.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_geography.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_technology.required' => 'Bạn chưa nhập điểm công nghệ',
        'gpa_technology.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_technology.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_informatics.required' => 'Bạn chưa nhập điểm tin học',
        'gpa_informatics.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_informatics.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_civic_education.required' => 'Bạn chưa nhập điểm GDCD',
        'gpa_civic_education.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_civic_education.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_national_defense_education.required' => 'Bạn chưa nhập điểm GDQP',
        'gpa_national_defense_education.gte' => 'Điểm phải lớn hơn hoặc bằng 0',
        'gpa_national_defense_education.lte' => 'Điểm phải nhỏ hơn hoặc bằng 10',
        'gpa_physical_education.required' => 'Bạn chưa chọn kết quả',
    ];
}
}
