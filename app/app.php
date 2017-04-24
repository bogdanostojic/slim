<?php

use Respect\Validation\Validator as v;			//Koristimo klasu Respect koju smo skinuli sa neta preko koje mozemo da vrsimo validaciju podataka i instanca te klase je v.

session_start();								//Uspostavljamo sesiju

require __DIR__ . '/../vendor/autoload.php';	//Importujemo sve nase zavisne podatke za aplikaciju ili dependencies


$app = new \Slim\App([							//$app je instanca SLIM-a, i prosledjjemo parametre za konfiguraciju slima.
	'settings' => [
		'displayErrorDetails' => true,			//Hocemo da prikaemo greske dok razvijamo applikaciju
	'db' => [									//Specifikacije za bazu podataka, koristimo mysql i host je localsho,naziv baze projekat
		'driver' => 'mysql',
		'host' => 'localhost',
		'database' => 'projekat',
		'username' => 'root',
		'password' => 'root',
		'charset' => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix' => '',
			]
	],

]);



$container = $app->getContainer();						//$container, pravimo instancu kontejnera. Kontejner je u sustini niz ciji su elementi objekti nekih klasa, znaci niz objekata.
														//Preko njega povezujemo sve sto hocemo za nas kontejner, kao sto je klasa za autentikaciju, validaciju i rad za bazama

$capsule = new \Illuminate\Database\Capsule\Manager;			//Preko capsule se konektujemo na bazu preko Eloqenta, to nam je dependency koji smo skinuli sa neta i ovo je uvek tako. Preko nje mozemo da koristimo Eloqeunt van Laravel framework-a

$capsule->addConnection($container['settings']['db']);  		// 	ubacujemo nase podatke iz kotejnera, kazemo na koju bazu hocemo da konektujemo		/\	Sve 
$capsule->setAsGlobal();										//	postavljamo kao globalnu promenljivu da mozemo preko modela da pravimo korisnike	||	ovo
$capsule->bootEloquent();										//	pokrecemo eloquent																	||	mora
																//																						||	tako   
																//																						||	da
$container['db'] = function ($container) use ($capsule){		//	hocemo da koristimo kapsulu u kontejneru, tako mora da bude							||	bude da bi radio Eloquent, ovo levo je dodatno objasnjenje.
	return $capsule;											//	i vracamo kapsulu da mozemo da koristimo u kontrolerima								\/
};

$container['auth'] = function($container){
	return new \App\Auth\Auth;
};


$container['view'] = function ($container) {							//Kada hocemo da koristimo niz sa indeksom koji se zove "view", on ce nam vratiti objekat te klase i on ce sadrzati funkciju ciji je parametar $container
																		//,da bismo mogli da koristimo neke druge elemente kontejnera u tom objektu
	$view = new \Slim\Views\Twig(__DIR__ . '/../ostalo/views/', [ 		//Pravimo novu instancu Twig-a, i to je instanca \Slim\Views\Twig i unutar toga prvi parametar je gde cuvamo nase view-ove u nasem slucaju odemo "gore" jedan folder da izadjemo iz app-a sa /,,/ i onda gde se nalaze nasi view-ovi u /ostalo/views.
			'cache' => false,									  		//Drugi parametar je niz opcija i 'cache' => false on koristi uvek na vezbama.	
		]);
	$view->addExtension(new \Slim\Views\TwigExtension(					//Preko TwigExtension-a generisemo URL-ove ka razlicitim rutama u nasim view-ovima i ono je instanca TwigExtension-a
			$container->router,											//Prvi parametar je router koji grabimo iz naseg kontejnera, treba nam jer pravimo url-ove za nase linkove
			$container->request->getUri()								//Drugi da dobijemo trenutni Uri , ito preko request, request je odgovran za trenutni zahtev na stranici i samo getUri() funkcija
		));

	$view->getEnvironment()->addGlobal('auth', [		//Proveravamo da li je korsinik ulogovan i setujemo njihovo ime u navigacioni meni
			'check' =>$container->auth->check(),
			'user' => $container->auth->user(),
		]);

	return $view;
};

$container['validator'] = function ($container){ 						//Stavljamo ili vezujemo za kontejner validator klasu sto smo skinuli sa interneta preko komposera
	return new \App\Validation\Validator;
};

$container['HomeController'] = function($container){
	return new \App\Controllers\HomeController($container); 			// vezujemo kontroler za kontejner
};

$container['PasswordController'] = function($container){
	return new \App\Controllers\Auth\PasswordController($container); 	// Isto tako i za sifru kontroler
};

$container['AuthController'] = function($container){
	return new \App\Controllers\Auth\AuthController($container);		//Isto tako i za kontoler za autentikaciju
};

$container['csrf'] = function($container){								//Stavljamo u kontroler objekat klase CSRF sto smo skinuli sa neta kao dependency za nasu aplikaciju
	return new \Slim\Csrf\Guard;
};




$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));  // Preko ove tri linije importujemo Middleware, prvi je middleware koji proverava greske
$app->add(new \App\Middleware\OldInputMiddleware($container));			// Ako je validno jedno polje, a drugo nije onda ovaj middleware cuva to sto valja da korisnik ne mora ponovo da kuca
$app->add(new \App\Middleware\CsrfViewMiddleware($container));			// Csrf middleware (Cross Site request forgery) prosledjuje broj (strucni naziv "token") i preko njega sprecavamo Csrf napade preko nekog,
																		// unesenog polja u "post" formi (Sign in-u ili Sign up-u).

$app->add($container->csrf); // Upalili CSRF

v::with('App\\Validation\\Rules\\');									//Dozvoljamao nasoj Validation biblioteci da koristi nasa pravila.


require __DIR__ . '/routes/routes.php';  //Importujemo rutu iz routes foldera
