<?php
class Topico extends AppModel{
    var $name = "Topico";
    
    var $belongsTo = array(
        'Series' => array(
            'className' => 'Serie',
        ),
        
    );
    
    
    var $hasMany = array(
        'Informacao' => array(
            'className' => 'Informacao',
        ),
    );
    
}
?>