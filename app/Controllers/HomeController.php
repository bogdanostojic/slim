<?php

namespace App\Controllers;

use App\Models\User;	//Koristimo klasu user

								//Nasledjujemo klasu Controller u kojoj pristupamo kontejneru i gledamo da li postoji to sto nam treba iz kontejnera
class HomeController extends Controller 
{

	public function index($request, $response) // Metode koje pozivamo u routes.php fajlu
	{

		$user = User::all(); // Izlista sve korisnike u bazi podataka
		
		return $this->view->render($response, 'home.twig', ['user' => $user]); //Za pristup drugim elementima kontrolera, da bi se prikazao neki view, prvi parametar je odgovor koji saljemo,
																			   // Drugi view koji vracamo, a treci je neki podatak koji hocemo da vratimo, u ovom slucaju da nam izlista sve korisnike iz baze. 
	}																		   // Pomocu treceg mozemo da prosledimo niz podataka u ovom slucaju korisnike pod imenom user nasem home.twig view-u.


	public function postUserDelete($request, $response)			//Funkcija za brisanje
	{
		$userid = $request->getParam('delete');					//Gleda da li je kliknuto dugme za delete i prosledjuju mu se parametri i cuvamo u promenljivu $userid
		$_SESSION['id'] = $userid;								//SMestamo to $_SESSION['id']
		$user = User::find($userid);							//Nalazimo korisnika sa tim ID-om
		$user->delete();										// I brisemo ga
		$user = User::all();									// I ponovo nam izlistavamo sve iz baze
		return $this->view->render($response, 'home.twig', ['user' => $user]);
	}

	public function postUserUpdate($request, $response) // Metoda za brisanje
	{
		
		$id = $request->getParam('update');
		$_SESSION['id'] = $id;
		$user = User::find($id);

		//var_dump($_SESSION['id']);
		$email = $request->getParam('email');
		
		var_dump($email);

		$a = $this->db->table('users')->where('id', '=', $id)->update(['email' => $email]);  //u $a promenljivu cuvamo rezultat nase pretrage, da trazi tabelu users, i gde se poklapa id sa korisnikom kojeg zelimo da azuriramo da azuriramo email adresu sa onim sto smo uneli u polje
		//$this->view->render($response, 'imeupdate.twig', [ 'id' => $imeid, 'ime' => $ime->ime, 'prezime' => $ime->prezime]);
		//var_dump($user->email);
		//var_dump($id);
		$a = User::all();		
		return $this->view->render($response, 'home.twig', ['user' => $a]);
		
	}

}