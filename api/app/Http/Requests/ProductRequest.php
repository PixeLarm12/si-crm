<?php

namespace App\Http\Requests;

use App\Enums\ProductEnum;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
	public function rules() : array
	{
		return [
			'title'  => 'required|min:3|max:150',
			'price'  => 'required|numeric',
			'amount' => 'required|integer',
			'status' => 'sometimes|nullable|integer',
		];
	}

	public function messages() : array
	{
		return [
			'title.required'  => 'Title is required',
			'title.min'       => 'Title must have at least 3 characters',
			'title.max'       => 'Title cannot be longer than 150 characters',
			'price.numeric'   => 'Price must be numeric',
			'amount.required' => 'Amount is required',
			'amount.integer'  => 'Amount must be integer',
			'status.integer'  => 'Status must be integer',
		];
	}

	public function getData() : array
	{
		return [
			'title'  => $this->input('title'),
			'price'  => $this->input('price'),
			'amount' => $this->input('amount'),
			'status' => $this->input('status') ?? ProductEnum::STATUS_DRAFT,
		];
	}
}
