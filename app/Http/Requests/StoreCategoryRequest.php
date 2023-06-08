<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'category_name'=>'required|unique:categories|min:2',
            'icon_category'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute không được bỏ trống',
            'unique'=>':attribute đã tồn tại',
            'min'=>':attribute quá ngắn, ít nhất :min ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'category_name'=>'Tên danh mục',
            'icon_category'=>'Icon'
        ];
    }
    protected function withValidator($validator){
        $validator->after(function($validator){

        });
    }
    protected function prepareForValidation()
    {

    }

    protected function failedAuthorization()
    {

    }
}
