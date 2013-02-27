<?php
class Servidor extends AppModel{
    var $name = "Servidor";
    
    var $hasMany = array(
        'Links' => array(
            'className' => 'Link',
        ),
    );
    
    var $validate = array(
        'nome' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'O Nome não pode ficar em Branco',
            ),
            'alphaNumeric'=>array(
                'rule' => 'alphaNumeric',
                'message' => 'Apenas números ou letras são permitidos',
            ),
            'required'=>TRUE
        )
        
    );
    
}
?>