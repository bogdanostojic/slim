<?php

namespace App\Auth;

use App\Models\User;

class Auth
{

	public function user()
	{
		return User::find($_SESSION['user']);		//Vrati prvi i jedini slucaj gde je korisnik ulogovan
	}

	public function check()
	{
		return isset($_SESSION['user']);		//Proverava da li je postavljena sesija
	}

	public function attempt($email, $password)
	{
		// trazimo korisnika po email-u, ako ga nema vraca false
		$user = User::where('email', $email)->first();

		if(!$user){
			return false;		// Ukoliko ne postoji vraca false
		}

		if (password_verify($password, $user->password))		//Proverava sifru sa passowrd_verify php metodom za rehashuje sifru i upredi i ukoliko se uklopi podesi user globalnu promenljivu sa id-om korisnika koji se ulogovao
		{

			$_SESSION['user'] = $user->id;

			return true;
		}
	return false;

	}



}