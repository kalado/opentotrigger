<?php
class IndexController extends AppController{
    
    /**
     * Adiciona ou Edita um novo idioma
     */  
    public function index(){
        $capitulos = $this->Capitulo->find('all',array('fields'=>array('anime_id') , 'order'=>array('Capitulo.created DESC'),'group'=>array('anime_id'),'recursive'=>0));
        $series = array();
        $animes = array();
        foreach($capitulos as $capitulo){
            $anime_id = $capitulo['Capitulo']['anime_id'];
            $serie_id = $this->Anime->getField($anime_id,'serie_id');
            
            if(array_search($serie_id, $series)===FALSE){
                $series[] = $serie_id;
                $animes[array_search($serie_id, $series)] = $anime_id;
            }
        }
        $series_tmp = $series;
        $series = array();
        foreach($series_tmp as $key => $serie_id){
            $serie = $this->Serie->find('first',array('fields'=>array('Serie.id','Serie.nome','Serie.imagem','Serie.sinopse'),'conditions'=>array('Serie.id'=>$serie_id),'recursive'=>0));
            $multimidia_nova_id = $this->Anime->getField($animes[$key],'multimidia_id');
            $animes_da_serie = $this->Anime->find('all',array('fields'=>array('Anime.id','Anime.nome','Anime.multimidia_id'),'conditions'=>array('Anime.serie_id'=>$serie_id),'recursive'=>-1));
            
            $multimidias_tmp = array();
            $multimidias = array();
            foreach ($animes_da_serie as $anime_da_serie) {
                $multimidia_id = $anime_da_serie['Anime']['multimidia_id'];
                $multimidia = $this->Multimidia->find('first',array('fields'=>array('Multimidia.nome'),'conditions'=>array('Multimidia.id'=>$multimidia_id),'order'=>array('Multimidia.nome'),'recursive'=>-1));
                
                if(array_search($multimidia_id, $multimidias_tmp)===FALSE){
                    $multimidias_tmp[] = $multimidia_id;
                    $multimidias[] =
                array(
                        'id'=>$multimidia_id,
                        'nome'=>$multimidia['Multimidia']['nome'],
                        'nova'=>($multimidia_id==$multimidia_nova_id)
                     );
                }
                
            }
            
            $serie['Multimidias'] = $multimidias;
            
            $series[$key] = $serie;
        }
                $this->set(
                array(
                    'series'=>$series,
                    'title_for_layout' => 'Home'
                )
                );
    }
    
    public function login(){
        $this->layout = 'login';
        $campos = array(
                ' ' => array(
                    'login' => array(),
                    'senha' => array('type'=>'password'),
                )
            );
        
        $this->set(array(
            'campos'=>$campos
        ));
    }
    
    
}

?>