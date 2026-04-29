<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Requests\Cart;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $product = $this->route('product');

        $this->merge([
            'product_id' => $product instanceof Product ? $product->getId() : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => __('validation.product_required'),
            'product_id.integer' => __('validation.product_integer'),
            'product_id.exists' => __('validation.product_exists'),
            'quantity.required' => __('validation.quantity_required'),
            'quantity.integer' => __('validation.quantity_integer'),
            'quantity.min' => __('validation.quantity_min'),
        ];
    }
}
