<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:50',
            'email' => 'required|unique:users',
            'password' => 'required_unless:id|min:8|max:60',
            'cpf' => 'required||min:11|max:11',
            'birth_date' => 'required|date',
            'address' => 'required||min:3|max:120',
            'address_number' => 'required|min:1|max:15',
            'address_neighborhood' => 'required|min:3|max:120',
            'address_complement' => 'required|min:3|max:120',
            'address_zipcode' => 'required|min:8|max:8',
            'role' => 'required|integer|min:1',
        ];
    }

    public function getData(): array
    {
        return [

        ];
    }
}
