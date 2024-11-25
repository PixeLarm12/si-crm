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

	public const TYPE_RECOMMENDATION = 2;

	public const TYPE_PROBLEM = 3;

	// Default Title
	public const TITLE_NEW_PURCHASE = "New purchase.";
	public const TITLE_NEW_RECOMMENDATION = "Recommendation";
	public const TITLE_NEW_PROBLEM = "Problem detected";

	// Default Messages
	public const MESSAGE_PURCHASE = "Your transaction was made.";
	public const MESSAGE_RECOMMENDATION = "I guess you'll like these too...";
	public const MESSAGE_PROBLEM = "Ops... Something went wrong.";
}
