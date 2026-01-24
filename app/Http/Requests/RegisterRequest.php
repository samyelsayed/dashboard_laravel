<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required'],
            'email'=>['required','email','uniqe:users'], //email لا تداهي ريجولار اكسبيريشن بس لازم الاميل يكون فية @ , . علشان يقبل ويونيك يوزر يعني يعني الاميل  يونيكك في جدول اليوزر
            'phone' => ['required', 'regex:/^01[0-2,5,9]{1}[0-9]{8}$/', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'] ,     //بتتشك ان الباسورد و الكونفيرم باسورد زي بعض بس بشرط الكونفيرم باسورد يبقا الكي بتاعه الاسم زي و ادر اسكول كونفيرميشن مثلا باسورد اندر اسكول  كونفيرميشن
            'device_name' => ['required']
            ];

    }
}
