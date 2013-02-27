<?php
class Qualidade extends AppModel{
    var $name = "Qualidade";
    
    var $hasMany = array(
        'Links' => array(
            'className' => 'Link',
            
        ),
    );
    
    var $hasAndBelongsToMany = array(
        'Multimidias' => array(
            'className' => 'Multimidia',
            'joinTable' => 'compativel',
        )
    );
    
    
}
?>