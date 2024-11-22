<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
{
	public function rules() : array
	{
		return [
			'user_id'    => 'required|integer',
			'product_id' => 'required|integer',
			'rate'       => 'required|numeric',
		];
	}

	public function messages() : array
	{
		return [
			'user_id.required'    => 'User ID is required',
			'user_id.integer'     => 'User ID must be integer',
			'product_id.required' => 'Product ID is required',
			'product_id.integer'  => 'Product ID must be integer',
			'rate.required'       => 'Rate is required',
			'rate.numeric'        => 'Rate must be numeric',
		];
	}

	public function getData() : array
	{
		return [
			'user_id'    => $this->input('user_id'),
			'product_id' => $this->input('product_id'),
			'rate'       => $this->input('rate'),
			'date'       => Carbon::now(),
		];
	}
}
