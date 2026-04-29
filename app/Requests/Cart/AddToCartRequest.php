<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => __('validation.product_required'),
            'product_id.integer' => __('validation.product_integer'),
            'product_id.exists' => __('validation.product_exists'),
            'quantity.integer' => __('validation.quantity_integer'),
            'quantity.min' => __('validation.quantity_min'),
        ];
    }
}
