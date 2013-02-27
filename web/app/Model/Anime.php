<?php
class Anime extends AppModel{
    var $name = "Anime";
    
    var $hasAndBelongsToMany = array(
       'Criado' => array(
            'className' => 'Autor',
            'joinTable' => 'autoria_anime',
        )
    );
    
    var $belongsTo = array(
        'Serie' => array(
            'className' => 'Serie',
        ),
        'Multimidia' => array(
            'className' => 'Multimidia',
        ),
        'Idioma' => array(
            'className' => 'Idioma',
        ),
        'Status' => array(
            'className' => 'Status',
        ),
        'Fansub' => array(
            'className' => 'Fansub',
        )
    );
    
    
    public function afterSave( $created ){
        $id = $this->getInsertID();
        if(empty($id))$id=$this->data[$this->name]['id'];
        
        foreach($this->data[$this->name]['autores'] as $autor){
            $valores[] = '('.$autor.','.$id.')';
        }
        $this->query(
                    'DELETE FROM autoria_anime '.
                        'WHERE anime_id='.$id.
                    ';'.
                    'INSERT INTO autoria_anime '.
                        'VALUES '.
                            implode(",", $valores).
                        ' ;');
    }
    
    
    public function getAutores($id){
        $qualidades = $this->query(
                    'SELECT * FROM autoria_anime AS Autores '.
                        'WHERE '.
                            'Autores.anime_id='.$id.
                        ' ;');
        
        return $qualidades;
    }
    
    
}
?>