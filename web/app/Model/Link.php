<?php
class Link extends AppModel{
    var $name = "Link";
    
    var $belongsTo = array(
        'Captulo' => array(
            'className' => 'Captulo',
        ),
        'Qualidade' => array(
            'className' => 'Qualidade',
        ),
        'Servidor' => array(
            'className' => 'Servidor',
        ),
        'Status' => array(
            'className' => 'Status',
        )
    );
    
    
}
?>