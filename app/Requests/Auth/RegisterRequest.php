<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.name_required'),
            'name.min' => __('validation.name_min'),
            'email.required' => __('validation.email_required'),
            'email.email' => __('validation.email_invalid'),
            'email.unique' => __('validation.email_unique'),
            'password.required' => __('validation.password_required'),
            'password.min' => __('validation.password_min'),
            'password.confirmed' => __('validation.password_confirmed'),
        ];
    }
}
