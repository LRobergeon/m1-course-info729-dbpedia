<?php

// Composer autoloader, charge toutes les dépendances du projets (comme pom.xml en Maven)
require_once '../vendor/autoload.php';

//Utilise la classe Main qui se trouve à l'endroit du namespace DBpedia\App (comme un package)
//J'utilise la classe Main en tant que App
use DBpedia\App\Main as App;

//Crée l'instance de l'application qui sera utilisée par démarée par le index.php
$app = new App();

//TODO Faire ici les configurations de $app si besoin