<?php
class Autor extends AppModel{
    var $name = "Autor";
      
    var $hasAndBelongsToMany = array(
        'Series' => array(
            'className' => 'Serie',
            'joinTable' => 'autoria_serie',
        //    'associationForeignKey'=>'serie_id'
        ),
        'Animes' => array(
            'className' => 'Anime',
            'joinTable' => 'autoria_anime',
        )
    );
    
    
     var $validate = array(
        'nome' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'O Nome não pode ficar em Branco',
            ),
        )
        
    );
     
}
?>