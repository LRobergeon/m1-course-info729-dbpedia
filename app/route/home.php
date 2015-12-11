<?php

$app->get('/', function() use ($app){
    
    
    $app->render('home', [
        'nom'   => 'Bob',
    ]);
})->name('home');