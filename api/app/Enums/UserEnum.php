<?php 

namespace App\Enums;

use App\Enums\AbstractEnum;

class UserEnum extends AbstractEnum
{
    public const ADMIN = 1;
    public const CLIENT = 2;
    public const EMPLOYEE = 3;
}