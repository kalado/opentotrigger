<?php
class SerieController extends AppController{
    
    /**
     * Adiciona ou Edita uma nova serie
     */
    
    private function gerarMenuSerieADMIN($id){
        
        $animes = $this->Anime->find('all',array('conditions'=>array('Anime.serie_id'=>$id)));
        
        /*
         Ainda tenho que pensar na forma de ordenação
         quem saber exibir
         
         (Multimida)Nome do Anime
         
         
         */
        
        
        // -anime 1 (id - nome_unidade)
        // -anime 2
        // -anime 3
        // -manga 1
        // -manga 2
        // -OVA 1
        // -filme 1
        // -filme 2
        // -filme 3
        // -filme 4
        
        
        $serie = $this->Serie->getField($id,'nome');
        $this->set(
                array(
                        "serie_nome"=>$serie,
                        "serie_id"=>$id,
                        "menu_da_serie" => array(),
                    )
                );
        
    }


    private function save($id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Serie->save($this->request->data);
            if($save!==FALSE){
                $this->Session->setFlash("A serie foi salva com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Serie->getInsertID();
                $id = ((empty($id))?$this->request->data['Serie']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar a serie, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
        }
        if($id != ""){
            $this->request->data = $this->Serie->find('first',array('conditions' => array($this->name.'.id' => $id) , 'fields'=>array('id','nome','sinopse','status_id')));
            if(!empty ($this->request->data['Autoria'])){
                foreach ( $this->request->data['Autoria'] as $autor){
                    $autores[] = $autor['id'];
                }
            }else{
                $autores = array();
            }
            $this->request->data['Serie']['autores'] = $autores;
            $this->gerarMenuSerieADMIN($id);
        }
        if($id!=NULL)$this->page_title = $this->Serie->getField($id,'nome');
        $fildset = (($id==NULL)?"Nova Serie":"Editar Serie");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'nome' => array('required'=>TRUE , 'class'=>'input-block-level'),
                    'sinopse' => array('type'=>'textarea-editor'),
                    'status_id' => array('label'=>'Status','type'=>'select','options'=>$this->Status->getArraySimples('nome'),'class'=>'input-block-level'),
                    'autores' => array('label'=>'Autores' , 'type'=>'checkbox-inline', 'options' => $this->Autor->getArraySimples('nome')),
                )
            );
        
            $this->set(
                        array(
                                'model' => 'Serie',
                                'campos' => $campos,
                            )
                    );
    }
    
    public function novo(){
        $this->beforeAdmin();
        $this->save();
        $this->render('save');
    }
    
    
    public function edit($id){
        $this->beforeAdmin();
        $this->save($id);
        $this->render('save');
    }
    
    
    public function lista(){
        $this->beforeAdmin();
        $lista = $this->getPaginate('Serie', array('Serie.nome') , array('id','nome'));
        $this->set(
                array(
                    'fields' => array('#'=>'Serie.id','Nome'=>'Serie.nome'),
                    'data' => $lista,
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Serie->getField($id,'nome');
        $deletado = $this->Serie->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("A serie (".$nome.") foi deletada com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("A serie (".$nome.") não pode ser deletada!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>