<?php

namespace App\Enums;

class UserEnum extends AbstractEnum
{
	public const ROUTE_PREFIX = 'users';
	
	public const ADMIN = 1;

	public const CLIENT = 2;

	public const EMPLOYEE = 3;
}