<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'discount_title'=>['required','max:255','min:5'],
            'discount_code' => ['required', 'max:255','unique:discounts'],
            'price_sale'=>['required', 'integer'],
            'quantity'=>['required', 'integer'],
            'package_id' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ];
    }

    public function messages(){
        return [
            'required'=>':attribute không được bỏ trống',
            'max'=>':attribute tối đa 255 kí tự',
            'min'=>':attribute tối thiểu 5 kí tự',
            'discount_code.unique'=>':attribute đã tồn tại',
            'integer' => ':attribute phải là dạng số',
            'package_id.required' => 'Chọn gói tập được giảm giá',
//            'price_sale.max' => ':attribute tối đa 2 kí tự',
        ];

    }
}
