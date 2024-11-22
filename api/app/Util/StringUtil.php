<?php

namespace App\Util;

class StringUtil
{
	public static function getValidationErrorsMessages($errors) : array
	{
		$messages = [];

		foreach ($errors as $field => $error) {
			foreach ($error as $content) {
				array_push($messages, $content);
			}
		}

		return $messages;
	}
}