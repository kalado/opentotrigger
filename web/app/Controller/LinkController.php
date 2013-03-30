<?php
class LinkController extends AppController{
    
    /**
     * Adiciona ou Edita um novo link
     */
    private function save($id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Link->save($this->request->data);
            if($save!==FALSE){
                $this->Session->setFlash("O link foi salvo com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                if($id!=NULL){
                        $this->redirect(array('action' => 'edit' , $id ));
                }
                $this->redirect(array('controller' => 'capitulo', 'action' => 'edit' , $this->request->data['Link']['capitulo_id'] ) );
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o link, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
            
        }
        
        $qualidades_aceitas_options = array();
        if($id != ""){
            $this->request->data = $this->Link->find('first',array('conditions' => array('id' => $id)));
            
            $qualidades_aceitas_options = $this->Multimidia->getQualidadesAceitas($this->Anime->getField($this->Capitulo->getField($this->request->data['Link']['capitulo_id'],'anime_id'),'multimidia_id'));
            
        }
        
        if($id!=NULL)$this->page_title = $this->Link->getField($id,'nome');
        $fildset = (($id==NULL)?"Novo link":"Editar link");
        
        $campos = array(
                $fildset => array(
                    'capitulo_id' => array("type"=>"hidden"),
                    'url' => array('required'=>TRUE),
                    'servidor_id' => array('label'=>'Servidor','type'=>'select','options'=>$this->Servidor->getArraySimples('nome')),
                    'qualidade_id' => array('label'=>'Qualidade','type'=>'select','options'=>$qualidades_aceitas_options),
                )
            );
        
        $this->set(
                    array(
                        'model' => 'Link',
                        'campos' => $campos
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
    
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Link->getField($id,'nome');
        $deletado = $this->Link->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("O link foi deletado com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("O link não pode ser deletado!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>