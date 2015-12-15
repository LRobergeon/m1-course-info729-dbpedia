<?php

use EasyRdf\Sparql\Client as Sparql;

$app->get('/', function() use ($app) {

    $sparql = new Sparql('http://fr.dbpedia.org/sparql');
    
    $default_langue = 'fr';
    
    $liste_villes = $sparql->query(
        "
        prefix db-owl: <http://dbpedia.org/ontology/>
        select ?departement, ?nom where {
            ?departement rdf:type dbpedia-owl:Department .
            ?departement dbpedia-owl:region dbpedia-fr:Rhône-Alpes .
            ?departement rdfs:label ?nom .
            FILTER ( LANGMATCHES(LANG(?nom), \"$default_langue\") ) .
        }
        order by ?nom
        "
    );
    
    $langues = [
        'fr', 'en', 'pl', 'de', 'pt', 'es', 'eu', 'ca', 'it', 'hu', 'id', 'tr', 'nl', 'cs', 'bg', 'ru', 'ja', 'ko'
    ];
    
    $app->render('home', [
        'isEmpty'               => true,
        'default_form_value'    => array(
            'pop_min'       => 10,
            'default_lang'  => $default_langue,
        ),
        'langues'               => $langues,
        'liste_villes'          => array_map(function( $elem ){
                return array(
                    $elem->departement->getUri() => $elem->nom->getValue()
                );
            }, (array) $liste_villes ),
        
    ]);
})->name('home');
