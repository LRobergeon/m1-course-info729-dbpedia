<?php

use EasyRdf\Sparql\Client as Sparql;

function nomAccess( $elem )
{
    return $elem->nom->getValue();
}

$app->get('/query', function() use ($app) {
    
    $sparql = new Sparql('http://fr.dbpedia.org/sparql');
    /**
     *  Trois critères de recherches : 
     *      - departement
     *      - nombre d'habitants
     *      - langue d'affichage
     */
    //$departement = "http://fr.dbpedia.org/resource/Savoie_(département)"
    
    $default_langue = 'fr';
    
    $departement = $app->request()->params('dpt');
    $nb_habitants = $app->request()->params('pop');
    $langue = $app->request()->params('lang');
    $order_by = $app->request()->params('order_by');
    $order = $app->request()->params('order');
    
    $villes = $sparql->query(
        "
        prefix db-owl: <http://dbpedia.org/ontology/>
        select ?nom, ?population, ?comment where {
            ?ville db-owl:department <$departement> .
            ?ville rdf:type db-owl:Settlement .
            ?ville db-owl:populationTotal ?population .
            ?ville rdfs:label ?nom .
            ?ville rdfs:comment ?comment .
            FILTER (?population > $nb_habitants) .
            FILTER ( LANGMATCHES(LANG(?nom), \"$langue\") ) .
            FILTER ( LANGMATCHES(LANG(?comment), \"$langue\") ) .
        }
        order by $order(?$order_by)
        "
    );
    
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
        'isEmpty'               => count( $villes ) <= 0,
        'default_form_value'    => array(
            'pop_min'       => 10,
            'dpt_selected'  => '',
            'lang_selected' => $default_langue,
            'order_by'      => array(
                'nom'           => array(
                    'label'     => "Nom",
                    'checked'   => true,
                ),
                'population'    => array(
                    'label'     => "Nombre d'habitants",
                    'checked'   => false,
                ),
            ),
            'order'         => array(
                'ASC'   => array(
                    'label'     => "ASC",
                    'checked'   => true,
                ),
                'DESC'  => array(
                    'label'     => "DESC",
                    'checked'   => false,
                ),
            ),
        ),
        'selected_filters'      => array(
            'dpt'       => $departement,
            'pop'       => $nb_habitants,
            'lang'      => $langue,
            'order_by'  => $order_by,
            'order'     => $order,
        ),
        'langues'               => $langues,
        'villes'                => array_map(function( $elem ){
                return array( 
                    'nom'           => $elem->nom->getValue(),
                    'population'    => $elem->population->getValue(),
                    'comment'       => $elem->comment->getValue(),
                );
            }, (array) $villes ),
        'liste_villes'          => array_map(function( $elem ){
                return array(
                    $elem->departement->getUri() => $elem->nom->getValue()
                );
            }, (array) $liste_villes ),
    ]);
    
})->name('query');