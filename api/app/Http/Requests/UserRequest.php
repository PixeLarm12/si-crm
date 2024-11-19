<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
	public function rules() : array
	{
		return [
			'name'                 => 'required|min:3|max:50',
			'email'                => 'required|unique:users',
			'password'             => 'required_unless:id,null|confirmed|min:8|max:60',
			'cpf'                  => 'required|min:11|max:11',
			'birth_date'           => 'required|date',
			'address'              => 'required|min:3|max:120',
			'address_number'       => 'required|min:1|max:15',
			'address_neighborhood' => 'required|min:3|max:120',
			'address_complement'   => 'sometimes|required|min:3|max:120',
			'address_zipcode'      => 'required|min:8|max:8',
			'role'                 => 'required|integer|min:1',
			'phones'               => 'required|array|min:1',
			'phones.*.user_id'     => 'required|integer',
			'phones.*.phone'       => 'required|min:10|max:15',
		];
	}

	public function messages() : array
	{
		return [
			'name.required'                 => 'Name is required',
			'name.min'                      => 'Name must have at least 3 characters',
			'name.max'                      => 'Name cannot be longer than 50 characters',
			'email.required'                => 'Email is required',
			'email.unique'                  => 'Email must be unique',
			'password.required_unless'      => 'Password is required',
			'password.min'                  => 'Password must have at least 8 characters',
			'password.max'                  => 'Password cannot be longer than 60 characters',
			'password.confirmed'            => 'Password and Password confirm must match each other',
			'cpf.required'                  => 'CPF is required',
			'cpf.min'                       => 'CPF must have at least 11 characters to match CPF format',
			'cpf.max'                       => 'CPF cannot be longer than 11 characters',
			'birth_date.required'           => 'Birth date is required',
			'birth_date.date'               => 'Birth date must be an date format',
			'address.required'              => 'Address is required',
			'address.min'                   => 'Address must have at least 3 characters',
			'address.max'                   => 'Address cannot be longer than 120 characters',
			'address_number.required'       => 'Address number is required',
			'address_number.min'            => 'Address number must have at least 1 characters',
			'address_number.max'            => 'Address number cannot be longer than 15 characters',
			'address_neighborhood.required' => 'Address neighborhood is required',
			'address_neighborhood.min'      => 'Address neighborhood must have at least 3 characters',
			'address_neighborhood.max'      => 'Address neighborhood cannot be longer than 120 characters',
			'address_complement.min'        => 'Address complement must have at least 3 characters',
			'address_complement.max'        => 'Address complement cannot be longer than 120 characters',
			'address_zipcode.required'      => 'Address is required',
			'address_zipcode.min'           => 'Address must have at least 8 characters to match zipcode format',
			'address_zipcode.max'           => 'Address zipcode cannot be longer than 11 characters',
			'role.required'                 => 'Role is required',
			'role.min'                      => 'Role needs to be greater than 0',
			'role.integer'                  => 'Role must be integer',
			'phones.required'               => 'Phone is required',
			'phones.array'                  => 'Phone must be array',
			'phones.min'                    => 'Phone must have at least 1 added',
			'phones.*.user_id.required'     => 'Phone user ID is required',
			'phones.*.user_id.integer'      => 'Phone user ID must be integer',
			'phones.*.phone.required'       => 'Phone number is required',
			'phones.*.phone.min'            => 'Phone number must have at least 10 numbers',
			'phones.*.phone.max'            => 'Phone number cannot be longer than 15 numbers',
		];
	}

	public function getData() : array
	{
		return [
			'name'                 => $this->input('name'),
			'email'                => $this->input('email'),
			'password'             => $this->input('password'),
			'cpf'                  => $this->input('cpf'),
			'birth_date'           => $this->input('birth_date'),
			'address'              => $this->input('address'),
			'address_number'       => $this->input('address_number'),
			'address_neighborhood' => $this->input('address_neighborhood'),
			'address_complement'   => $this->input('address_complement'),
			'address_zipcode'      => $this->input('address_zipcode'),
			'role'                 => $this->input('role'),
			'phones'               => $this->input('phones'),
		];
	}
}
