<?php
class Fansub extends AppModel{
    var $name = "Fansub";
    var $useTable = 'fansub';
    
    var $hasAndBelongsToMany = array(
        'Animes' => array(
            'className' => 'Anime',
            'joinTable' => 'fansub_animes',
        )
    );
    
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