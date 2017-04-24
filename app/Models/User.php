<?php

namespace App\Models; // Kada napravimo fajl dodeljuje se namespace, da ne bi svaki pojedinacno ucitavali preko autoload-a composer.json-u, sve se automatski ucita.

use Illuminate\Database\Eloquent\Model; //Koristimo Eloquent model klasu

//Klasa User nasledjuje klasu Model i sada mozemo da koristimo ovaj model kao direktnu vezu sa nasmo tabelom u bazi podataka

class User extends Model 
{
	protected $table = 'users';

	protected $fillable = [		//Definisemo koje entitete imamo u tabeli, da mozemo da update-ujemo i brisemo iz te tabele, mora tako.

		'name',
		'email',
		'password',

	];

	public function setPassword($password)			//Pomocu ove metode uzimamo nasu novu sifru
	{
		$this->update([	//i ovde azuriramo nasu novu sifru, moramo da hashujemo sifru i azurirali smo je.

				'password' => password_hash($password, PASSWORD_DEFAULT)	
			]);
	}

}
