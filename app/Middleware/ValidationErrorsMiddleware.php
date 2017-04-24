<?php

namespace App\Middleware;		//Jer je u istom folderu sa nasim Middleware klasom, ne moramo da ga importujemo da bi ga nasledili

class ValidationErrorsMiddleware extends Middleware
{	
	// invoker je magicna metoda u php-u, imamo 3 parametra. Request response i next,
	//next je paametar koji sluzi da znamo kojem sledecem middleware-u da prosledimo
	//Jer middleware je kao slojevi luka koje ljustimo da bi smo dosli do srzi applikacije.

	public function __invoke($request, $response, $next)
	{
		$this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']); //Ovde pristupamo tim globalnim greskama, i ako postoje psotavimo ih u nase view-ove
		unset($_SESSION['errors']); // i onda posle toga unsetujemo jer nam ne trebaju


		$response = $next($request, $response); 
		return $response;

	} 
}