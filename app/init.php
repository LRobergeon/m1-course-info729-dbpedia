<?php

// Composer autoloader, charge toutes les dépendances du projets (comme pom.xml en Maven)
require_once '../vendor/autoload.php';
require_once '../app/utils/functions.php';

//Utilise la classe Main qui se trouve à l'endroit du namespace DBpedia\App (comme un package)
use DBpedia\App;

//Crée l'instance de l'application qui sera utilisée par démarée par le index.php
$app = new App();

require_once 'routes.php';
