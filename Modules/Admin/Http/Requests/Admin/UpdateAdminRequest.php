<?php

namespace Modules\Admin\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:20',
            'username' => 'required|string|min:5|max:20',[Rule::unique('admins')->ignore($this->admin)],
            'mobile' => 'required|string|regex:/(^09\d{9}$)/u',[Rule::unique('admins')->ignore($this->admin)],
            'email' => 'email|min:3|max:255|nullable',[Rule::unique('admins')->ignore($this->admin)],
            'password' => 'required|string|confirmed|min:8',
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

            'name.required' => 'لطفا نام خود را وارد کنید',
            'name.string' => 'لطفا نام خود را بصورت صحیح وارد کنید',
            'name.min' => 'نام شما نمیتواند کمتر از ۳ کاراکتر باشد',
            'name.max' => 'نام شما نمیتواند بیشتر از ۲۰کاراکتر باشد',

            'username.required'=> 'لطفا نام کاربری خود را وارد کنید',
            'username.string'=> 'لطفا نام کاربری خود را بصورت صحیح وارد کنید',
            'username.unique'=> 'این نام کاربری قبلا استفاده شده است.لطفا از نام دیگری استفاده کنید.',
            'username.min'=> 'نام کاربری نمیتواند کمتر از ۳ کاراکتر باشد',
            'username.max'=> 'نام کاربری نمیتواند بیشتر از ۲۰کاراکتر باشد',

            'mobile.required' => 'لطفا شماره موبایل خود را وارد کنید',
            'mobile.unique' => 'این شماره قبلا استفاده شده است.لطفا از شماره دیگری استفاده کنید',
            'mobile.regex' => 'لطفا شماره موبایل را به فرمت صحیح وارد کنید',

            'email.email' => 'لطفا ایمیل را به فرمت صحیح وارد کنید',
            'email.unique' => 'این ایمیل قبلا استفاده شده است.لطفا از ایمیل دیگری استفاده کنید',
            'email.min' => ' ایمیل نمیتواند کمتر از ۲ کاراکتر باش',
            'email.max' => 'ایمیل نمیتواند بیشتر از ۲۵۵ کاراکتر باشد',

            'password.required' => 'لطفا رمز عبور خود را وارد کنید',
            'password.confirmed' => 'لطفا رمز عبور خود را مجددا وارد کنید',
            'password.min' => 'رمز عبور نباید کمتر از 8 حرف باشد',

        ];
    }
}
