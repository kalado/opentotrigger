<?php
class Anime extends AppModel{
    var $name = "Anime";
    
    var $hasAndBelongsToMany = array(
        'Criado' => array(
            'className' => 'Autor',
            'joinTable' => 'autoria_anime',
        ),
        'Fansubs' => array(
            'className' => 'Fansub',
            'joinTable' => 'fansub_animes',
        )
    );
    
    var $hasMany = array(
        'Capitulos' => array(
            'className' => 'Capitulo',
        ),
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
        
        
        foreach($this->data[$this->name]['fansubs'] as $fansub){
            $fansubs[] = '('.$fansub.','.$id.')';
        }
        $this->query(
                    'DELETE FROM fansub_animes '.
                        'WHERE anime_id='.$id.
                    ';'.
                    'INSERT INTO fansub_animes '.
                        'VALUES '.
                            implode(",", $fansubs).
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