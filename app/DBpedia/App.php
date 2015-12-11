<?php

//Comme un package Java, on trouvera cette classe à DBpedia\App\Main
namespace DBpedia;

//Comme un import en Java, possibilité de mettre des alias également
use Whoops\Run as WhoopsRun;
use Whoops\Handler\PrettyPageHandler as WhoopsPrettyPageHandler;
use Slim\Slim;

/**
* Classe principale de l'application
* Point d'entrée
*/
class App extends Slim {
	
	/**
	* Constructeur par défaut de la class Main
	* #WeirdSyntax
	*/
	public function __construct()
	{
		parent::__construct([
			'debug'	=> true,
		]);
		$this->initWhoops();
	}
	
	/**
	* Initialise la librairie Whoops
	* Whoops est une librairie PHP qui permet d'afficher les erreurs proprement, c'est tout
	*/
	protected function initWhoops()
	{
		$whoops = new WhoopsRun();
		$handler = new WhoopsPrettyPageHandler();
		$whoops->pushHandler( $handler )->register();
	}
	
	/**
	* Permet l'affichage d'une vue avec les données spécifiées
	*/
	public function render( $view, $data = [] )
	{
		include_once( '../app/view/'.$view.'.php' );
	}
}