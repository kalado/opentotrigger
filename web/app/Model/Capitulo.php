<?php
class Capitulo extends AppModel{
    var $name = "Captulo";
    
    var $belongsTo = array(
        'Anime' => array(
            'className' => 'Anime',
        )
    );
    
}
?>