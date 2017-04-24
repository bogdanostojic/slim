<?php

namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException; 	//Koristimo Validator dependency koji smo skinuli sa neta 
use Respect\Validation\Validator as Respect;					//Koristimo Validator dependency koji smo skinuli sa neta 

class Validator
{
	protected $errors;

	public function validate($request, array $rules) //Preko ove metode provera nas request nas i ispituje da li se poklapa sa nekim pravilima koje smo mi napisali
	{	
		try
		{
		foreach ($rules as $field => $rule)			//za svako pravilo koje smo prosledili ovoj funkciji, izvrtece ga i proveriti da li se poklapaju
		{
			$rule->setname(ucFirst($field))->assert($request->getParam($field));	//Prosledjujemo polja i proveravamo pravila
		}

		} 
		catch (NestedValidationException $e)		// Ukoliko postoji greska
		{
			$this->errors[$field] = $e->getMessages();	//Greska koja nam se izbacila u zavisnosti od polja
		}

		$_SESSION['errors'] = $this->errors;			//Ako ima gresaka, stavljamo ih kao globalne promenljive u $_SESSION['errors']
		return $this;									//Vratice trenutni objekat
	}

	public function failed() 			//Proverava da li ima gresaka
	{
		return !empty($this->errors); 	
	}

}