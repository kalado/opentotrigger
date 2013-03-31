<?php
class Topico extends AppModel{
    var $name = "Topico";
    
    var $belongsTo = array(
        'Series' => array(
            'className' => 'Serie',
            'foreignKey'=>'serie_id'
        ),
        
    );
    
    
    var $hasMany = array(
        'Informacoes' => array(
            'className' => 'Informacao',
        ),
    );
    
}
?>