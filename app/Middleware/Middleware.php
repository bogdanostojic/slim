<?php

//Middleware koristi nas kontejner, to je svaki sloj provere gde proveravamo i podesavamo neke podatke od korisnika i tek onda prosledjujemo nasoj aplikaciji, kao slojevi zasite

namespace App\Middleware;
							//Isto kao za kontroler, pravimo bazicni middleware i mozemo da prosledimo kontejner nasim middleware-ima
class Middleware			
{
	protected $container;

	public function __construct($container)
	{
		$this->container = $container;
	}
}