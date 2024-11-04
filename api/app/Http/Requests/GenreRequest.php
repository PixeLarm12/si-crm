<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|min:2|max:50',
        ];
    }
   
    public function messages(): array
{
    return [
        'title.required' => 'Title is required',
        'title.min' => 'Title must have at least 2 characters',
        'title.max' => 'Title cannot be longer than 50 characters',
    ];
}

    public function getData(): array
    {
        return [
            'title' => $this->input('title'),
        ];
    }
}
