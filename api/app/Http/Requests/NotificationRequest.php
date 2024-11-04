<?php

namespace App\Http\Requests;

use App\Enums\NotificationEnum;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
	public function rules() : array
	{
		return [
			'user_id' => 'required|integer',
			'title'   => 'required|min:3|max:50',
			'message' => 'required|min:3|max:255',
			'type'    => 'required|integer',
		];
	}

	public function messages() : array
	{
		return [
			'user_id.required' => 'User ID is required',
			'user_id.integer'  => 'User ID must be integer',
			'title.required'   => 'Title is required',
			'title.min'        => 'Title must have at least 3 characters',
			'title.max'        => 'Title cannot be longer than 50 characters',
			'message.required' => 'Message is required',
			'message.min'      => 'Message must have at least 3 characters',
			'message.max'      => 'Message cannot be longer than 255 characters',
			'type.integer'     => 'Type must be integer',
		];
	}

	public function getData() : array
	{
		return [
			'user_id' => $this->input('user_id'),
			'title'   => $this->input('title'),
			'message' => $this->input('message'),
			'type'    => $this->input('type'),
			'date'    => Carbon::now(),
			'status'  => $this->input('status') ?? NotificationEnum::STATUS_UNREAD,
		];
	}
}
