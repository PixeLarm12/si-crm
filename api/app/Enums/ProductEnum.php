<?php

namespace App\Enums;

class ProductEnum extends AbstractEnum
{
	public const ROUTE_PREFIX = 'products';

	// Status
	public const STATUS_DRAFT = 0;

	public const STATUS_PUBLISHED = 1;
}
