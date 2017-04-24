<?php

namespace App\Controllers\Auth;


use App\Models\User;
use App\Controllers\Controller; 
use Respect\Validation\Validator as v;

class AuthController extends Controller
{


		public function getSignOut($request, $response) //Metoda pomocu koje izlogujemo korisnika
	{
		session_unset();
		session_destroy(); 
		return $response->withRedirect($this->router->pathFor('auth.signin'));
	}
	public function getSignIn($request, $response) // Ovom metodom preusmeravamo korisnika na twig template za logovanje korisnika
	{
			return $this->view->render($response, 'auth/signin.twig');
	}

	public function postSignIn($request, $response) // Pomocu ove metode prosledjujemo podatke iz forme za logovanje korsinika
	{
		$auth = $this->auth->attempt(				//Koristimo nasu auth klasu i proveravamo da li postoji korisnik sa istim emailom i sa tim passwordom

			$request->getParam('email'),
			$request->getparam('password')

			);

		if(!$auth){
			return $response->withRedirect($this->router->pathFor('auth.signin')); 	// Ukoliko se ne poklapa, vrati nas na stranicu za logvanje
		}

		return $response->withRedirect($this->router->pathFor('home'));		//Ukoliko je sve uspesno ulogujemo se
	}

	public function getSignUp($request, $response) // Kada se klikne sign up dugme ova metoda generise  signup.twig fajl.
	{
		//var_dump($request->getAttribute('csrf_value'));

		return $this->view->render($response, 'auth/signup.twig');
	}

	public function postSignUp($request, $response) 			//Prosledjujemo formu za registraciju
	{
		
		$validaton = $this->validator->validate($request, [		//Prvo proveravamo dali su sva pravila koja smo mi naveli u ovom nizu izpostovana, ako nisu izbacice gresku. 

				'name' => v::notEmpty()->alpha(),								//Proveravamo da li je prazno polje 
				'email' => v::noWhitespace()->notEmpty()->email()->emailSlobodan(),	//nema space-a u email-u, i nase pravilo da li je Email zauzet
				'password' => v::noWhitespace()->notEmpty(),

			]);


		if($validaton->failed()){			//Ukoliko neko pravilo nije izpostovano, preusmerice nas ponovo na registracijonu formu

				return $response->withRedirect($this->router->pathFor('auth.signup'));
		}

		$user = User::create([																		//Ako je validacija prosla uspesno pravimo korisnika i prosledjujemo parametre iz polja

				'email' => $request->getParam('email'),
				'name' => $request->getparam('name'),
				'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),		// password_hash funkcijom Hash-ujemo sifru i tako cemo je cuvati u bazi podataka, prvi parametar funkcije je sta hocemo da hashujemo, a drugi je algoritam koji hocemo da koristimo.
			]);

		$this->auth->attempt($user->email, $request->getParam('password'));							//Kada smo napravili korisnika, ulogujemo ga tj. autentikaciju odradimo preko attempt funkcije

		return $response->withRedirect($this->router->pathFor('home')); 							// Ako je sve proslo kako treba onda ce se prikazati pocetna stranica ulogovanom korisniku.
	}

}