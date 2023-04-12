<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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

        $rules = [
            "name" => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:15'],
            "last_name" => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:15'],
            "position" => ['bail', 'required', 'regex:/^[\pL\s\-]+$/u', 'min:3', 'max:30'],
        ];
        if ($this->input('form') === 'create') {
            $rules ['email'] = ['bail', 'required', 'email',
                Rule::unique('users')
            ];
            $rules ['password'] = ['bail', 'required', 'min:8',
                Rule::unique('users')
            ];
        } else {
            $rules ['email'] = ['bail', 'required', 'email',
                Rule::unique('users')->ignore($this->input('id'))
            ];
        }

        return ($rules);
    }

    public function messages()
    {
        return [
            /*Custom Validation Messages for Above Validation Rules*/
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'min' => ':attribute حداقل باید :min حرف باشد',
            'max' => ':attribute حداکثر باید :max حرف باشد',
            'unique' => 'ایمیل وارده قبلا در سیستم موجود است',
        ];
    }

    public function attributes()
    {
        return [
            /*Custom attribute name for incoming attributes name*/
            'name' => 'نام',
            'last_name' => 'فامیلی',
            'position' => 'نوعیت حساب کاربری',
            'email' => 'ایمیل آدرس',
            'password' => 'رمز عبور',
        ];
    }
}
