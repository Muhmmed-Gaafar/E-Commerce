<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rate' => 'nullable|integer|min:1|max:5',
            'price' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'price_after_tax' => 'nullable|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'colors' => 'nullable|array',
            'sizes' => 'nullable|array',
            'images'=>'nullable|array',
            'types'=>'nullable|array',
            'stock' => 'nullable|integer|min:0',
            'is_favorite' => 'nullable|boolean',
        ];
    }
}
