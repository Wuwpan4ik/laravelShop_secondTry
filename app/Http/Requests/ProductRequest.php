<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'code' => 'required|min:3|max:255|unique:products,code',
            'description' => 'required|min:5',
            'price' => 'required|numeric|min:1',
            'count' => 'numeric|min:0'
        ];
        if ($this->route()->named('products.update')) {
            $rules['code'] .= ',' . $this->route()->parameter('product')->id;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно иметь минимум :min символов',
            'max' => 'Поле :attribute должно иметь минимум :max символов',
            'price.min' => 'Минимальная цена - 1 рубль'
        ];
    }
}
