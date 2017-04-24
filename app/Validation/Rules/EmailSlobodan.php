<?php

namespace App\Validation\Rules;

use App\Models\User;
//Pravimo svoja pravila da li se nesto proklapa za nas validator. Za svako pravilo moramo da imamo i izuzetak

use Respect\Validation\Rules\AbstractRule;

class EmailSlobodan extends AbstractRule

{

	public function validate($input)
	{
		return User::where('email', $input)->count() === 0;		//Proverava da li ima slobodnog email-a
	}
}