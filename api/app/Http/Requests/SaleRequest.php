<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
	public function rules() : array
	{
		return [
			'user_id'             => 'required|integer',
			'total_price'         => 'required|numeric',
			'items'               => 'required|array',
			'items.*.product_id'  => 'required|integer',
			'items.*.amount'      => 'required|integer',
			'items.*.unit_price'  => 'required|numeric',
			'items.*.total_price' => 'required|numeric',
		];
	}

	public function messages() : array
	{
		return [
			'total_price.required'         => 'Total price is required',
			'total_price.numeric'          => 'Total price must be numeric value',
			'user_id.required'             => 'User ID is required',
			'user_id.integer'              => 'User ID must be integer',
			'items.array'                  => 'Items must be an array',
			'items.*.product_id.required'  => 'Item product ID is required',
			'items.*.product_id.integer'   => 'Item product ID must be an integer',
			'items.*.amount.required'      => 'Item amount is required',
			'items.*.amount.integer'       => 'Item amount must be an integer',
			'items.*.unit_price.required'  => 'Item unit price is required',
			'items.*.unit_price.numeric'   => 'Item unit price must be numeric',
			'items.*.total_price.required' => 'Item total price is required',
			'items.*.total_price.numeric'  => 'Item total price must be numeric',
		];
	}

	public function getData() : array
	{
		return [
			'user_id'     => $this->input('user_id'),
			'total_price' => $this->input('total_price'),
			'date'        => $this->input('date') ?? Carbon::now(),
			'items'       => $this->input('items'),
		];
	}
}
