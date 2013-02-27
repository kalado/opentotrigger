<?php
class Serie extends AppModel{
    var $name = "Serie";
    
    var $hasAndBelongsToMany = array(
       'Autoria' => array(
            'className' => 'Autor',
            'joinTable' => 'autoria_serie',
        )
    );
    
    var $hasMany = array(
        'Topicos' => array(
            'className' => 'Topico',
        ),
    );
    
    var $belongsTo = array(
        'Status' => array(
            'className' => 'Status',
        )
    );
    
    
    public function afterSave( $created ){
        $id = $this->getInsertID();
        if(empty($id))$id=$this->data[$this->name]['id'];
        
        foreach($this->data[$this->name]['autores'] as $autor){
            $valores[] = '('.$autor.','.$id.')';
        }
        $this->query(
                    'DELETE FROM autoria_serie '.
                        'WHERE series_id='.$id.
                    ';'.
                    'INSERT INTO autoria_serie '.
                        'VALUES '.
                            implode(",", $valores).
                        ' ;');
    }
    
    
    public function getAutores($id){
        $qualidades = $this->query(
                    'SELECT * FROM autoria_serie AS Autores '.
                        'WHERE '.
                            'Autores.series_id='.$id.
                        ' ;');
        
        return $qualidades;
    }
    
    
}
?>