<?php

namespace App\Http\Requests;

use App\Enums\AssistanceEnum;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AssistanceRequest extends FormRequest
{
	public function rules() : array
	{
		return [
			'opened_by'  => 'required|integer',
			'admin_id'   => 'sometimes|required|integer',
			'type'       => 'required|integer',
			'subject'    => 'required|min:3|max:50',
			'message'    => 'required|min:3|max:255',
			'close_date' => 'sometimes|required|date',
			'status'     => 'sometimes|required|integer',
		];
	}

	public function messages() : array
	{
		return [
			'opened_by.required' => 'Opened by is required',
			'opened_by.integer'  => 'Opened by must be integer',
			'admin_id.integer'   => 'Admin ID must be integer',
			'type.required'      => 'Type is required',
			'type.integer'       => 'Type must be integer',
			'subject.required'   => 'Subject is required',
			'subject.min'        => 'Subject must have at least 3 characters',
			'subject.max'        => 'Subject cannot be longer than 50 characters',
			'message.required'   => 'Message is required',
			'message.min'        => 'Message must have at least 3 characters',
			'message.max'        => 'Message cannot be longer than 255 characters',
			'close_date.date'    => 'Close date must be a date',
			'status.integer'     => 'Status must be an integer',
		];
	}

	public function getData() : array
	{
		return [
			'opened_by'  => $this->input('opened_by'),
			'admin_id'   => $this->input('admin_id'),
			'type'       => $this->input('type'),
			'subject'    => $this->input('subject'),
			'message'    => $this->input('message'),
			'open_date'  => Carbon::now(),
			'close_date' => $this->input('close_date'),
			'status'     => $this->input('status') ?? AssistanceEnum::STATUS_OPENED,
		];
	}
}
