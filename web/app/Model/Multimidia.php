<?php
class Multimidia extends AppModel{
    var $name = "Multimidia";
    
    
    
    var $hasAndBelongsToMany = array(
        'Qualidades' => array(
            'className' => 'Qualidade',
            'joinTable' => 'compativel',
        )
    );
    
    
     var $validate = array(
                            'nome' => array(
                                'notEmpty' => array(
                                    'rule' => 'notEmpty',
                                    'message' => 'O Nome não pode ficar em Branco',
                                ),
                            ),
                            'unidade' => array(
                                'notEmpty' => array(
                                    'rule' => 'notEmpty',
                                    'message' => 'A unidade não pode ficar em Branco',
                                ),
                            )
                        );
    
    
    
    public function afterSave( $created ){
        $id = $this->getInsertID();
        if(empty($id))$id=$this->data[$this->name]['id'];
        foreach($this->data[$this->name]['formatos_aceitos'] as $qualidade){
            $valores[] = '('.$qualidade.','.$id.')';
        }
        $this->query(
                    'DELETE FROM compativel '.
                        'WHERE multimidia_id='.$id.
                    ';'.
                    'INSERT INTO compativel '.
                        'VALUES '.
                            implode(",", $valores).
                        ' ;');
    }
    
    public function getQualidadesAceitas($id){
        $qualidades = $this->query(
                    'SELECT * FROM compativel AS Compativel '.
                        'WHERE '.
                            'Compativel.multimidia_id='.$id.
                        ' ;');
        
        return $qualidades;
    }
    
}
?>