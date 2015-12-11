<?php

//Comme un package Java, on trouvera cette classe à DBpedia\App\Main
namespace DBpedia\App;

//Comme un import en Java, possibilité de mettre des alias également
use Whoops\Run as WhoopsRun;
use Whoops\Handler\PrettyPageHandler as WhoopsPrettyPageHandler;

/**
 * Classe principale de l'application
 * Point d'entrée
 */
class Main {
    
    private $_view;
    
    /**
     * Constructeur par défaut de la class Main
     * #WeirdSyntax
     */
	public function __construct()
	{
		$this->initWhoops();
		$this->_view = new View();
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
		return $this;
	}
    
    /**
     * Permet l'affichage d'une vue avec les données spécifiées
     */
    protected function render( $view, $data = [] )
    {
        return $this->_view->render( $view, $data );
    }
    
    /**
     * Point d'entrée de l'application 
     */
    public function run()
    {
        //TODO EasyRdf stuff
        
        $this->render('home');
    }
}