<?php
class Fansub extends AppModel{
    var $name = "Fansub";
    var $useTable = 'fansub';
    
    
//    
//    var $hasMany = array(
//        'Capitulo' => array(
//            'className' => 'Capitulo',
//        ),
//    );
//    
    
    var $validate = array(
        'nome' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'O Nome não pode ficar em Branco',
            ),
        ),
        'url' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'A url não pode ficar em Branco',
            ),
        ),
    );
    
}
?>