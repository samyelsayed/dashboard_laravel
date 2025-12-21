<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
                            'name_en'=>['required','string','max:256','min:2'], //بكتب اسم ال انبوت الي انا مسميه في الفورم و بحط الماكسيمم الي انا انا حاطة ف يالدا تا بيز و المينمم ولو مش محددها في الدات ابيز فدي حاجة ترجعلي
                'name_ar'=>['required','string','max:256','min:2'],
                'price'=>['required','numeric','max:99999.99','min:0.5'],
                'code'=>['required','integer','digits:5','unique:products,code'],
                'quantity'=>['nullable','integer','max:999','min:1'],  //nullable يعني تقبل انك تكتب فيها null واحنا في الداتا بيز كاتبين ان الديفولت بتاعها 1
                'desc_en'=>['required','string'],
                'desc_ar'=>['required','string'],
                'status'=>['required','string','between:0,1'],
                'subcategories_id'=>['required','integer','exists:subcategories,id'],  //بقوله ان الساب كاتجوري ايدي ال يهيجيلك لازم ييبقا موجود ف يجدول الصاب كاتجوري في عمود ال اي دي
                'brand_id'=>['required','integer','exists:brands,id'],
                'image'=>['required','max:1000','mimes:png,jpg,jpeg']  //ميمز بكتب الاكستنشن المسموح بية للصورة و ماكسيمم بكتب في اقصي حجم ليهها بالكيلو بايت

        ];
    }
}
