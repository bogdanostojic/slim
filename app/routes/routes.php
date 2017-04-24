<?php
/********** U zavisnosti koja ruta se iskoristi korisniku ce se prikaziti nesto na ekranu
			Prvi parametar je ime ili URL rute koji se nadovezuje na nas projekat, drugi parametar je sintaksa slima.
			Pre dvotacke je naziv kontolera kojeg hocemo da koristimo, a posle dvotacke ime metode koje hocemo da iskoristimo
			->setName('nekoIme')
			
*/
$app->get('/', 'HomeController:index')->setName('home'); 

$app->post('/', 'HomeController:postUserDelete')->setName('delete');

$app->post('/update', 'HomeController:postUserUpdate')->setName('update');

$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');

$app->post('/auth/signup', 'AuthController:postSignUp');


$app->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');

$app->post('/auth/signin', 'AuthController:postSignIn')->setName('auth.postSignIn');

$app->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');



$app->get('/auth/change', 'PasswordController:getChangePassword')->setName('auth.change');

$app->post('/auth/change', 'PasswordController:postChangePassword');

