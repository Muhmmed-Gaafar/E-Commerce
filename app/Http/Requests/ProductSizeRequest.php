<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSizeRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Change this if you need authorization logic
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string|max:255',
        ];
    }
}

