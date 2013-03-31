<?php
class Informacao extends AppModel{
    var $name = "Informacao";
    
    var $belongsTo = array(
        'Topico' => array(
            'className' => 'Topico',
        ),
        
    );
    
}
?>