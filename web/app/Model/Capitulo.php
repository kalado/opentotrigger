<?php
class Capitulo extends AppModel{
    var $name = "Capitulo";
    
    var $belongsTo = array(
        'Anime' => array(
            'className' => 'Anime',
        )
    );
    
}
?>