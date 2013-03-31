<?php
class Serie extends AppModel{
    var $name = "Serie";
    
    var $hasAndBelongsToMany = array(
       'Autoria' => array(
            'className' => 'Autor',
            'joinTable' => 'autoria_serie',
        ),
        'Generos' => array(
            'className' => 'Genero',
            'joinTable' => 'series_generos',
            'foreignKey'=>'serie_id'
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
        $return = parent::afterSave($created);
        
        $this->gerarLigacoesNovas( 'autoria_serie' , "series_id", $this->data[$this->name]['autores']);
        
        $this->gerarLigacoesNovas( 'series_generos' , "serie_id", $this->data[$this->name]['generos'], FALSE);
        
        return $return;
        
    }
    
    
    public function getAutores($id){
        $autores = $this->query(
                    'SELECT * FROM autoria_serie AS Autores '.
                        'WHERE '.
                            'Autores.series_id='.$id.
                        ' ;');
        
        return $autores;
    }
    
    public function getGeneros($id){
        $generos = $this->query(
                    'SELECT * FROM series_generos AS Generos '.
                        'WHERE '.
                            'Generos.serie_id='.$id.
                        ' ;');
        
        return $generos;
    }
    
    
}
?>