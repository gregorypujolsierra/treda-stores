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
            'name' => 'required|string|max:128',
            'sku' => 'required|string|max:64|unique:products,sku,' . $this->product,
            'description' => 'required|string|max:128',
            'price' => 'required|min:0|int',
            'store' => 'required|int',
        ];

        if ($this->hasFile('image')) {
            $rules = array_merge($rules, ['image' => 'mimes:jpg,jpeg,png']);
        }

        return $rules;
    }
}
