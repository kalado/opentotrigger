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
            'genero' => 'Generos',
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
    
    function MenuNoticiasSerieADMIN($serie_id){
        $this->ModelRegistre('Topico');
        $this->ModelRegistre('Serie');
        
        
        $topicos = $this->Topico->find('all',array('conditions'=>array('Topico.serie_id'=>$serie_id)));
        
        $menu_noticias = array();
        foreach($topicos as $topico){
            $menu_noticias[] =
                    array(
                        'nome' => $topico['Topico']['nome'],
                        'noticias' => $topico['Informacoes']
                    );
        }
        
        //Noticias (serie_nome)
        //Novo Tópico
        //Nova noticia (serie_id)
        //Topico
            //Titulo 01 (EDIT - DELETE)
            //Titulo 02 (EDIT - DELETE)
            //Titulo 03 (EDIT - DELETE)
            //Titulo 04 (EDIT - DELETE)
        //Outro topico
            //Titulo 01 (EDIT - DELETE)
            //Titulo 02 (EDIT - DELETE)
            //Titulo 03 (EDIT - DELETE)
            //Titulo 04 (EDIT - DELETE)
                
        
        
        return array(
            "menu_noticiasSerie_nome" => $this->Serie->getField($serie_id,'nome'),
            "meni_noticias_serie_id"=> $serie_id,
            "menu_noticias" => $menu_noticias,
        );
    }
    
    
    function MenuTopADMIN($parte,$id){
        switch ($parte) {
            case 'anime':
                $this->ModelRegistre('Anime');
                $this->set(array(
                                'menu_top_anime_id' =>$id,
                                'menu_top_anime_nome' =>$this->Anime->getField($id,'nome')
                            ));
                break;

            default:
                break;
        }
    }
}
?>
