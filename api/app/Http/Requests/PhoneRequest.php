<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'phone' => 'required|min:10|max:15',
        ];
    }
   
    public function messages(): array
{
    return [
        'phone.required' => 'Phone is required',
        'phone.min' => 'Phone must have at least 10 numbers',
        'phone.max' => 'Phone cannot be longer than 15 numbers',
        'user_id.required' => 'User ID is required',
        'user_id.integer' => 'User ID must be integer',
    ];
}

    public function getData(): array
    {
        return [
            'phone' => $this->input('phone'),
            'user_id' => $this->input('user_id'),
        ];
    }
}
