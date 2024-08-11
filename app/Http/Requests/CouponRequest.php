<?php

namespace App\Http\Requests;

use App\Rules\DateRange;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'code' => [
                'nullable',
                'string',
                'max:255',
            ],
            'description' => 'nullable|string',
            'discount' => 'nullable|numeric|min:0',
            'type' => 'nullable|in:fixed,percent',

            'start_at' => 'nullable|date',
            'expired_at' => 'nullable|date|after:start_at',
//            'valid_date_range' => [
//                'nullable',
//                new DateRange($this->input('start_at'), $this->input('expired_at')),
//            ],
        ];
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('start_at') && $this->has('expired_at')) {
            $this->merge([
                'valid_date_range' => true,
            ]);
        }
    }
}


