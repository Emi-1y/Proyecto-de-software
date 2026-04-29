<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'payment_method' => 'required|in:cash,card,transfer',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('checkout.name')]),
            'email.required' => __('validation.required', ['attribute' => __('checkout.email')]),
            'phone.required' => __('validation.required', ['attribute' => __('checkout.phone')]),
            'address.required' => __('validation.required', ['attribute' => __('checkout.address')]),
            'city.required' => __('validation.required', ['attribute' => __('checkout.city')]),
            'postal_code.required' => __('validation.required', ['attribute' => __('checkout.postal_code')]),
            'payment_method.required' => __('validation.required', ['attribute' => __('checkout.payment_method')]),
        ];
    }
}
