<?php

class MenusComponent extends Component{

    function MenusComponent() {
        
    }

    private function ModelRegistre($modelName) {
        if(!isset($this->$modelName)){
            eval("\$this->" . $modelName . " = ClassRegistry::init('" . $modelName . "');");
        }
    }

    function MenuSerieADMIN($serie_id) {
        $this->ModelRegistre('Anime');
        $this->ModelRegistre('Serie');

        $animes = $this->Anime->find('all', array('conditions' => array('Anime.serie_id' => $serie_id) ,'order'=>array('Multimidia.nome','Anime.nome')));
        
        $animes_menu = array();
        $multimidia = "";
        foreach($animes as $anime){
            if($multimidia != $anime['Multimidia']['nome']){
                $multimidia = $anime['Multimidia']['nome'];
                $animes_menu[] = array('nome'=>$anime['Multimidia']['nome'] , 'id'=> FALSE );
            }
            $animes_menu[] = array('nome' =>$anime['Anime']['nome'] , 'id'=>$anime['Anime']['id'],'nome_unidade'=>$anime['Multimidia']['unidade']);
            
        }
        
        $serie = $this->Serie->getField($serie_id, 'nome');

        return array(
            "menu_serie_nome" => $serie,
            "menu_serie_id" => $serie_id,
            "menu_serie" => $animes_menu,
        );
    }

    function MenuEsquerdaADMIN() {
        return array(
            'Series',
            'serie' => 'Series',
            'Dados Tecnicos',
            'autor' => 'Autores',
            'fansub' => 'Fansubs',
            'Configurações',
            'servidor' => 'Servidores',
            'status' => 'Status',
            'multimidia' => 'Multimidias',
            'idioma' => 'Idiomas',
            'qualidade' => 'Qualidades',
        );
    }
    
    function MenuEpisodiosADMIN($anime_id){
        $this->ModelRegistre('Anime');
        $this->ModelRegistre('Capitulo');

        

        

        $anime = $this->Anime->find('first',array('conditions' => array('Anime.id' => $anime_id)));
        $capitulos = $this->Capitulo->find('all',array('conditions'=>array('Anime.id'=>$anime_id),'order'=>array('Capitulo.numero')));
        
        
        
        // -unidade 1 (edit-delete)
        // -unidade 2 (edit-delete)
        // -unidade 3 (edit-delete)
        // -unidade 4 (edit-delete)
        $animes_menu = array();
        foreach ($capitulos as $capitulo) {
            $animes_menu[] = array('numero'=>$capitulo['Capitulo']['numero'] , 'id' => $capitulo['Capitulo']['id']);
        }
        
        return array(
            "menu_capitulos_anime" => $anime['Anime']['nome'],
            "menu_capitulos_anime_id" => $anime['Anime']['id'],
            "menu_capitulos_nome_unidade" => $anime['Multimidia']['unidade'],
            "menu_capitulos_nome" => $anime['Multimidia']['nome'],
            "menu_capitulos" => $animes_menu,
        );
    }

}

?>
