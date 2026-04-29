<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'exclusive' => $this->boolean('exclusive'),
            'active' => $this->boolean('active'),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'size' => 'required|string|max:50',
            'brand' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'exclusive' => 'required|boolean',
            'image' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'color' => 'required|string|max:100',
            'discount' => 'required|integer|min:0|max:100',
            'active' => 'required|boolean',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
