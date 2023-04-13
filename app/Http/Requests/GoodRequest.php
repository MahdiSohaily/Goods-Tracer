<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodRequest extends FormRequest
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
            'serial' => ['bail', ' required', 'regex:/^[a-zA-Z0-9_.-]*$/', 'min:3', 'max:50'],
            'price' => ['bail', 'required', 'numeric', 'min:1'],
            'weight' => ['bail', 'required', 'numeric', 'min:1'],
            'dollar' => ['bail', 'nullable' ,'numeric:2'],
        ];
    }

    //custome validation messages
    public function messages()
    {
        return [
            'required' => 'وارد نمودن :attribute الزامی می باشد',
            'regex' => ':attribute باید تنها حروف الفبا در خود داشته باشد',
            'min' => ':attribute حداقل باید :min حرف باشد',
            'max' => ':attribute حداکثر باید :max حرف باشد',
            'unique' => 'ایمیل وارده قبلا در سیستم موجود است',
            'numeric' => 'فیلد مورد نظر تنها باید که عدد باشد',
            'decimal' => 'فیلد مورد نظر تنها باید که عدد به همراه ۲ عدد اعشاریه باشد.',
        ];
    }

    //custome field names in persian for validation
    public function attributes()
    {
        return [
            'name'=>'نام جنس',
            'serial'=>'سریال نمبر',
            'price'=>'قیمت جنس',
            'weight'=>'وزن جنس',
            'dollar'=>'نرخ تبادله',
        ];
    }
}
