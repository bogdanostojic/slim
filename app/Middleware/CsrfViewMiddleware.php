<?php


namespace App\Middleware;


class CsrfViewMiddleware extends Middleware
{
	public function __invoke($request, $response, $next)
	{
		
		$this->container->view->getEnvironment()->addGlobal('csrf', [			//Ovaj middleware nam pomaze da sprecimo CrossSiteRequestForgery (CSRF), i za svaku POST formu, treba nam csrf token da bi nam to uspelo i csrf token value key

			'field' => '

				<input type="hidden" name="'.$this->container->csrf->getTokenNameKey().'" value="'.$this->container->csrf->getTokenName().'">
				<input type="hidden" name="'.$this->container->csrf->getTokenValueKey().'" value="'. $this->container->csrf->getTokenvalue().'">
			',

			]);

		$response = $next($request, $response);

		return $response;
	}
}