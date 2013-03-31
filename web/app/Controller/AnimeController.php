<?php
class AnimeController extends AppController{
    
    /**
     * Adiciona ou Edita uma nova anime
     */
    private function save($id=NULL,$id_serie=NULL){
        if(!empty($this->request->data)){
            $save = $this->Anime->save($this->request->data);
            if($save!==FALSE){
                $this->Session->setFlash("O anime foi salvo com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Anime->getInsertID();
                $id = ((empty($id))?$this->request->data['Anime']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o anime, favor conferir os dados e tentar novamente!", "alert", array(
                    "plugin" => "TwitterBootstrap",
                    'class' => 'alert-error'
                ));
            }
        }
        if($id != ""){
            $this->request->data = $this->Anime->find('first',array('conditions' => array($this->name.'.id' => $id)));
            
            if(!empty ($this->request->data['Criado'])){
                foreach ( $this->request->data['Criado'] as $autor){
                    $autores[] = $autor['id'];
                }
            }else{
                $autores = array();
            }
            $this->request->data['Anime']['autores'] =  array_map("intval", $autores);
            
            
            if(!empty ($this->request->data['Fansubs'])){
                foreach ( $this->request->data['Fansubs'] as $fansub){
                    $fansubs[] = $fansub['id'];
                }
            }else{
                $fansubs = array();
            }
            $this->request->data['Anime']['fansubs'] =  array_map("intval", $fansubs);
            
            if(!empty ($this->request->data['Generos'])){
                foreach ( $this->request->data['Generos'] as $genero){
                    $generos[] = $genero['id'];
                }
            }else{
                $generos = array();
            }
            $this->request->data['Anime']['generos'] =  array_map("intval", $generos);
                        
        }
        if($id!=NULL){
            $this->page_title = $this->Anime->getField($id,'nome');
            $this->set($this->Menus->MenuTopADMIN('anime',$id));

        }else{
            $autores = $this->Serie->getAutores($id_serie);
            if(!empty($autores) ){
                foreach ( $autores as $autor){
                    $autores[] = $autor['Autores']['autor_id'];
                }
            }else{
                $autores = array();
            }
            $this->request->data['Anime']['autores'] =  array_map("intval", $autores);
            
            $generos = $this->Serie->getGeneros($id_serie);
            if(!empty($generos) ){
                foreach ( $generos as $genero){
                    $genero_final[] = $genero['Generos']['genero_id'];
                }
            }else{
                $genero_final = array();
            }
            $this->request->data['Anime']['generos'] =  array_map("intval", $genero_final);
            
            $this->set($this->Menus->MenuTopADMIN('serie',$id_serie));
        }
        $fildset = (($id==NULL)?"Novo Material":"Editar ".$this->data['Multimidia']['nome']);
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'serie_id' => array('type'=>'hidden','value'=>$id_serie),
                    
                    'multimidia_id' => array('label'=>'Multimidia','type'=>'select','options'=>$this->Multimidia->getArraySimples('nome'),'class'=>'input-block-level'),
                    'nome' => array('required'=>TRUE , 'class'=>'input-block-level'),
                    'apelido' => array('class'=>'input-block-level'),
                    'sinopse' => array('type'=>'textarea-editor'),
                    ),
                "Detalhes técnicos" => array(
                    'lancamento' => array('label'=>'Lançamento','class'=>'datePiker'),
                    'status_id' => array('label'=>'Status','type'=>'select','options'=>$this->Status->getArraySimples('nome')),
                    'autores' => array('label'=>'Autores' , 'type'=>'checkbox-inline', 'options' => $this->Autor->getArraySimples('nome')),
                    'fansubs' => array('label'=>'Fansubs' , 'type'=>'checkbox-inline', 'options' => $this->Fansub->getArraySimples('sigla')),
                    'idioma_id' => array('label'=>'Idioma','type'=>'select','options'=>$this->Idioma->getArraySimples('nome')),
                    'generos' => array('label'=>'Generos' , 'type'=>'checkbox-inline', 'options' => $this->Genero->getArraySimples('nome')),
                )
            );
        
            $this->set(
                        array(
                                'model' => 'Anime',
                                'campos' => $campos,
                            )
                    );
            
            $this->set($this->Menus->MenuSerieADMIN($id_serie));
            if(!empty($id)){
                $this->set($this->Menus->MenuEpisodiosADMIN($id));
            }

            
    }
    
    public function novo($id_serie){
        $this->beforeAdmin();
        $this->save(NULL,$id_serie);
        $this->render('save');
    }
    
    
    public function edit($id){
        $this->beforeAdmin();
        $this->save($id,$this->Anime->getField($id,'serie_id'));
        $this->render('save');
    }
    
    
    public function lista(){
        $this->beforeAdmin();
        $lista = $this->getPaginate('Anime', array('Anime.nome') , array('id','nome'));
        $this->set(
                array(
                    'fields' => array('#'=>'Anime.id','Nome'=>'Anime.nome'),
                    'data' => $lista,
                )
        );
    }
    
    public function delete($id , $serie_id = NULL){
        $this->beforeAdmin();
        $nome = $this->Anime->getField($id,'nome');
        $multimidia = $this->Multimidia->getField($this->Anime->getField($id,'multimidia_id'),'nome');
        $deletado = $this->Anime->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("O ".strtolower($multimidia)." (".$nome.") foi deletado com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("O ".strtolower($multimidia)." (".$nome.") não pode ser deletado!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        if(!empty($serie_id)){
            $this->redirect(array('controller' => 'serie','action' => 'edit',$serie_id));            
        }
        $this->redirect(array('controller' => 'anime','action' => 'lista',$serie_id));
    }
    
}

?>