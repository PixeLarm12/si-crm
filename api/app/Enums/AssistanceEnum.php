<?php

namespace App\Enums;

class AssistanceEnum extends AbstractEnum
{
	public const ROUTE_PREFIX = 'assistances';

	// Status
	public const STATUS_OPENED = 0;

	public const STATUS_CLOSED = 1;

	// Type
	public const TYPE_COMPLAINT = 1;

	public const TYPE_SUGGEST = 2;

	public const TYPE_PROBLEM = 3;
}
