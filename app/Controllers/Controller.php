<?php
namespace App\Controllers;
//************** Bazni kontroler, uvek je ovako i to je amin.  i njemu prosledjujemo kontejner
class Controller
{
	protected $container;
	public function __construct($container) // prihvatamo ga preko konstruktora u promenljviu
	{
		$this->container = $container;
	}

	public function __get($property)		//Preko get svojstva, to je magicna metoda i bilo koje svojstvo koje hocemo da pristupimo ce nam dozvoliti da baratamo sa njim
	{
		if ($this->container->{$property}) { // if uslov, ako postoji nesto sto nam treba iz kontejnera, proslidi nam to
			return $this->container->{$property};
		}
	}
}