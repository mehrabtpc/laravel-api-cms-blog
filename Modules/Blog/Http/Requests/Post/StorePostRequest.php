<?php

namespace Modules\Blog\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'content' => 'required|min:10',
            'published_at' => 'required',
            'user_id' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان خود را وارد کنید',
            'title.min' => 'عنوان شما باید حداقل 3 کاراکتر باشد',
            'description.required' => 'لطفا توضیحات خود را وارد کنید',
            'description.min' => 'توضیحات شما باید حداقل 3 کاراکتر باشد',
            'content.required' => 'لطفا محتوای خود را وارد کنید',
            'content.min' => 'متن محتوای شما باید حداقل 10 کاراکتر باشد',
            'published_at.required' => 'لطفا تاریخ انتشار خود را وارد کنید',
            'user_id.required' => 'برای انتشار پست،لطفا ابتدا لاگین کنید!',
        ];
    }
}
