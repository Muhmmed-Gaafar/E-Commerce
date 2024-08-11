<?php

// app/Http/Requests/FavoriteRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class FavoriteRequest extends FormRequest
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
        return [
            'product_id' => [
                'required',
                'exists:products,id',
            ],
        ];
    }

    public function messages()
    {
        return [
            'product_id.unique' => 'You have already added this product to your favorite.',
        ];
    }
}

