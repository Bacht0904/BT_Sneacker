<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'category_name'=>'min:2',
        ];
    }
    public function messages()
    {
        return [
            'min'=>':attribute quá ngắn, ít nhất :min ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'category_name'=>'Tên danh mục',
        ];
    }
}
