<?php


namespace App\Middleware;


class OldInputMiddleware extends Middleware
{
	public function __invoke($request, $response, $next)
	{
		
		$this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']); //Ovaj middleware nam sluzi da bi ostavili neke dobre podatke koje smo uneli u input polju
		$_SESSION['old'] = $request->getParams();		

		$response = $next($request, $response);

		return $response;
	}
}