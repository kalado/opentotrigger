<?php
class Genero extends AppModel{
    var $name = "Genero";
    
    
    var $hasAndBelongsToMany = array(
        'Series' => array(
            'className' => 'Serie',
            'joinTable' => 'series_generos',
            'associationForeignKey'=>'serie_id'
        ),
        'Animes' => array(
            'className' => 'Anime',
            'joinTable' => 'animes_generos',
        )
    );
    
    
}
?>