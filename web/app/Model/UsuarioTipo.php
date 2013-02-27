<?php
class UsuarioTipo extends AppModel{
    var $name = "UsuarioTipo";
    
    var $hasMany = array(
        'Usuarios' => array(
            'className' => 'Usuario',
            
        ),
    );
    
    var $validate = array(
        'nome' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'O nome do Tipo de Usuário não pode ficar em Branco',
            ),
        ),
        'permissao' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'A permissão do Tipo de Usuário não pode ficar em Branco',
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'A permissão deve ser um inteiro.',
            ),
            'between' => array(
                'rule' => array('between', 0, 10000),
                'message' => 'A permissão deve ser um inteiro entre %d e %d.',
            ),
        )
        
    );
    
    
}
?>