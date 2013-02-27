<?php
class Topico extends AppModel{
    var $name = "Topico";
    
    var $belongsTo = array(
        'Serie' => array(
            'className' => 'Serie',
        ),
        
    );
    
    
}
?>