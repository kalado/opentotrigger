<?php
class AnimeController extends AppController{
    
    /**
     * Adiciona ou Edita uma nova anime
     */
    
    


    private function save($id=NULL){
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
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o anime, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
        }
        if($id != ""){
            $this->request->data = $this->Anime->find('first',array('conditions' => array($this->name.'.id' => $id) , 'fields'=>array('id','nome','sinopse','status_id')));
            if(!empty ($this->request->data['Autoria'])){
                foreach ( $this->request->data['Autoria'] as $autor){
                    $autores[] = $autor['id'];
                }
            }else{
                $autores = array();
            }
            $this->request->data['Anime']['autores'] = $autores;
            $this->gerarMenuAnimeADMIN($id);
        }
        if($id!=NULL)$this->page_title = $this->Anime->getField($id,'nome');
        $fildset = (($id==NULL)?"Nova Anime":"Editar Anime");
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
                                'model' => 'Anime',
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
        $lista = $this->getPaginate('Anime', array('Anime.nome') , array('id','nome'));
        $this->set(
                array(
                    'fields' => array('#'=>'Anime.id','Nome'=>'Anime.nome'),
                    'data' => $lista,
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Anime->getField($id,'nome');
        $deletado = $this->Anime->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("O anime (".$nome.") foi deletada com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("O anime (".$nome.") não pode ser deletada!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>