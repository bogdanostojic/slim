<?php

namespace App\Validation\Exceptions;


//Pravimo svoje izuzetke da li je email slobodan. Za svaki izuzetak moramo da imamo i pravilo

use Respect\Validation\Exceptions\ValidationException;		

class EmailSlobodanException extends ValidationException
{
	public static $defaultTemplates = [		//Imamo template za defaultError greske zove se $defaultTemplates
		self::MODE_DEFAULT => [				//I imamo defalut mode koji je niz i tu sadrzimo nasu gresku

			self::STANDARD => 'Email je vec zauzet.',		
		],
	];
}