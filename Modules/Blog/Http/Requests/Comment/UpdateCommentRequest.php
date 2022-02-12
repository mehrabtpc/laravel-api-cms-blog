<?php

namespace Modules\Blog\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{

    public function rules()
    {
        return [
            'body' => 'required|min:5',
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
            'post_id.required' => 'لطفا پست خود را انتخاب کنید',
        ];
    }
}

