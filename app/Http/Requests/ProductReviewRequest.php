<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'rate' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'product_id' => 'nullable|exists:products,id'
        ];
    }
}

