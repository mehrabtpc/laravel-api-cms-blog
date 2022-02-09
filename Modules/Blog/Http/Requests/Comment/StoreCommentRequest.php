<?php

namespace Modules\Blog\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{

    public function rules()
    {
        return [
            'body' => 'required|min:5',
            'user_id' => 'required',
            'post_id' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
    public function messages()
    {
        return[
            'body.required' => 'لطفا نظر خود را وارد کنید',
            'body.min' => 'نظر شما باید حداقل 5 کاراکتر باشد',
            'user_id.required' => 'برای درج نظر، باید ابتدا وارد شوید',
            'post_id.required' => 'لطفا پست خود را انتخاب کنید',
        ];
    }
}
