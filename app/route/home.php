<?php

use EasyRdf\Graph;
use EasyRdf\Sparql\Client as Sparql;

function typeAccess( $elem )
{
    return $elem->type;
}

$app->get('/', function() use ($app){

    $sparql = new Sparql('http://fr.dbpedia.org/sparql');
    $types = $sparql->query(
        'select distinct ?type where {?x ?type ?concept} LIMIT 20'
    );
    //$graph = Graph::newAndLoad(site_base_uri().'asset/dataset/countries.rdf');
    
    $app->render('home', [
        'isEmpty'   => count( $types ) <= 0,
        'types'     => array_map("typeAccess", (array) $types ),
    ]);
})->name('home');
