<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'min:10', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => __('review.product_required'),
            'product_id.exists' => __('review.product_not_found'),
            'rating.required' => __('review.rating_required'),
            'rating.min' => __('review.rating_min'),
            'rating.max' => __('review.rating_max'),
            'comment.min' => __('review.comment_min'),
            'comment.max' => __('review.comment_max'),
        ];
    }
}
