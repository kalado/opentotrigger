<?php
class Link extends AppModel{
    var $name = "Link";
    
    var $belongsTo = array(
        'Capitulo' => array(
            'className' => 'Capitulo',
        ),
        'Qualidade' => array(
            'className' => 'Qualidade',
        ),
        'Servidor' => array(
            'className' => 'Servidor',
        )
    );
    
    
}
?>