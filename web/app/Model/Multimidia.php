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
        $qualidades = $this->find('first',array('conditions' => array($this->name.'.id' => $id )));
        $qualidades_aceitas_options = array();
        foreach($qualidades['Qualidades'] as $qualidade){
            $qualidades_aceitas_options[$qualidade['id']]=$qualidade['sigla'];
        }
        return $qualidades_aceitas_options;
    }

    
    
}
?>