<?php

use EasyRdf\Graph;
use EasyRdf\Format;
use \EasyRdf\Serialiser\GraphViz;

$app->get('/image', function() {
    
    $graph = Graph::newAndLoad(site_base_uri().'/asset/dataset/countries.rdf');
    $format = Format::getFormat('png');
    
    $viz = new GraphViz();
    
    header("Content-Type: ".$format->getDefaultMimeType());
    echo $viz->renderImage($graph, $format);
    die();
    
})->name('home');