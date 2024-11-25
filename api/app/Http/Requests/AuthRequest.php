<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
	public function rules() : array
	{
		return [
			'email'                => 'required|email',
			'password'             => 'required|min:8|max:60',
		];
	}

	public function messages() : array
	{
		return [
			'email.required'                => 'Email is required',
			'password.required'      => 'Password is required',
			'password.min'                  => 'Password must have at least 8 characters',
			'password.max'                  => 'Password cannot be longer than 60 characters',
		];
	}

	public function getData() : array
	{
		return [
			'email'                => $this->input('email'),
            'password'                => $this->input('password'),
		];
	}
}
