<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class MatchesPasswordException extends ValidationException
{
	public static $defaultTemplates = [			// isto kao i za EmailSlobodanExcaption
		self::MODE_DEFAULT => [

			self::STANDARD => 'Ne poklapa se sifra.',		
		],
	];
}