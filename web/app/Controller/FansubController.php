<?php
class FansubController extends AppController{
    
    /**
     * Adiciona ou Edita uma nova fansub
     */
    private function save($id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Fansub->save($this->request->data);
            if($save!==FALSE){
                $this->Session->setFlash("A fansub foi salva com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Fansub->getInsertID();
                $id = ((empty($id))?$this->request->data['Fansub']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar a fansub, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
            
        }
        
        if($id != ""){
            $this->request->data = $this->Fansub->find('first',array('conditions' => array('id' => $id) , 'fields'=>array('id','nome','sigla','url','slogan','sinopse')));
        }
        
        
        if($id!=NULL)$this->page_title = $this->Fansub->getField($id,'nome');
        $fildset = (($id==NULL)?"Nova Fansub":"Editar Fansub");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'nome' => array('class'=>'input-block-level'),
                    'sigla' => array('class'=>'input-block-level'),
                    'slogan' => array('class'=>'input-block-level'),
                    'url' => array('class'=>'input-block-level'),
                    'sinopse' => array('type'=>'textarea-editor','class'=>'input-block-level'),
                    
                )
            );
        
            $this->set(
                        array(
                                'model'=>'Fansub',
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
    
    
    public function lista(){
        $this->beforeAdmin();
        $lista = $this->getPaginate('Fansub', array('Fansub.nome') , array('id','nome','sigla'));
        $this->set(
                array(
                    'fields' => array('#'=>'Fansub.id','Nome'=>'Fansub.nome' , 'Sigla' => 'Fansub.sigla'),
                    'data' => $lista,
                    'virtualFields' => array(),
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Fansub->getField($id,'nome');
        $deletado = $this->Fansub->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("A fansub (".$nome.") foi deletado com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("A fansub (".$nome.") não pode ser deletado!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>