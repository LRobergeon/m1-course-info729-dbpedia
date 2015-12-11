<?php

namespace DBpedia\App;

class View {
    
    public function render( $view, $data = [] )
    {
        require_once '../app/view/' . $view . '.php';
    }
}