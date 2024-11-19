<?php

namespace App\Enums;

class NotificationEnum extends AbstractEnum
{
	public const ROUTE_PREFIX = 'notifications';

	// Status
	public const STATUS_UNREAD = 0;

	public const STATUS_READ = 1;

	// Type
	public const TYPE_PURCHASE = 1;

	public const TYPE_OFFER = 2;

	public const TYPE_PROBLEM = 3;
}
