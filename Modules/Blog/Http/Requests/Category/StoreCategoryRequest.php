<?php

namespace Modules\Blog\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'description' => 'nullable|min:3',
            'image' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
    public function messages()
    {
        return [
            'name.required' => 'نام دسته بندی اجباری است!',
            'name.min' => 'نام دسته بندی باید حداقل 3 کاراکتر باشد',
            'description.min' => 'توضیحات دسته بندی باید حداقل 3 کاراکتر باشد',
            'image.required' => 'عکس اجباری است',
        ];
    }
}
