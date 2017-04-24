<?php

namespace App\Controllers\Auth; // Namespace


use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class PasswordController extends Controller
{

	public function getChangePassword($request, $response) // svaka funkcija koju koristimo u kontrolerima ima zahtev(request) i odgovor (response) parametar
	{
		return $this->view->render($response, 'auth/password/change.twig'); // preko this pristupamo kontejeru i vadimo view iz naseg kontejnera i koristimo funkciju render, prvi parametar je odgovor i drugi je ime view-a koji hocemo da renedujemo
	}

	public function postChangePassword($request, $response)	//Za postavljanje nove sifre funkcija
	{

		$validation = $this->validator->validate($request, [

				'password_old' => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password), // za gledanje stare sifre validacija
				'password' => v::noWhitespace()->notEmpty(),		//za novu sifru provera validacije
			]);

		if($validation->failed()){

			return $response->withRedirect($this->router->pathFor('auth.change')); //Ukoliko je netacna sifra vraca nas na stranicu za promenu sifre
		}

		$this->auth->user()->setPassword($request->getParam('password')); 	//Ukoliko je proslo validaciju, pozivamo preko auth pristupamo trenutnom ulogovanom useru i metodi u user modelu set password i zahteva obican tekst, zato stavljamo samo iz text polja a ne hashovanu.
		return $response->withRedirect($this->router->pathFor('home'));		//Na kraju nas vrati samo na pocetnu stranicu
	}


}