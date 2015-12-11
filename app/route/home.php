<?php

$app->get('/', function() use ($app){

    $foaf = new EasyRdf_Graph("http://njh.me/foaf.rdf");
    $foaf->load();
    $me = $foaf->primaryTopic();
    
    $app->render('home', [
        'nom'   => $me->get('foaf:name'),
    ]);
})->name('home');