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
        ),
        'Autoria' => array(
            'className' => 'Autor',
            'joinTable' => 'autoria_anime',
        ),
        'Generos' => array(
            'className' => 'Genero',
            'joinTable' => 'animes_generos',
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
    
    
    var $dataFields = array("lancamento","finalizacao");
    
    
    public function afterSave( $created ){
        $return = parent::afterSave($created);
        
        $this->gerarLigacoesNovas('autoria_anime', 'anime_id', $this->data[$this->name]['autores'] );
        
        $this->gerarLigacoesNovas('fansub_animes', 'anime_id', $this->data[$this->name]['fansubs'] );
        
        $this->gerarLigacoesNovas('animes_generos', 'anime_id', $this->data[$this->name]['generos'] , FALSE );
        
        return $return;
    }
    
    public function getAutores($id){
        $autores = $this->query(
                    'SELECT * FROM autoria_anime AS Autores '.
                        'WHERE '.
                            'Autores.anime_id='.$id.
                        ' ;');
        
        return $autores;
    }
    
    public function getGeneros($id){
        $generos = $this->query(
                    'SELECT * FROM animes_generos AS Generos '.
                        'WHERE '.
                            'Generos.anime_id='.$id.
                        ' ;');
        
        return $generos;
    }
}
?>