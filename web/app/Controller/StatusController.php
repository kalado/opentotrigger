<?php
class StatusController extends AppController{
    
    /**
     * Adiciona ou Edita um novo status
     */
    private function save($id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Status->save($this->request->data);
            if($save!==FALSE){
                $this->Session->setFlash("O status foi salvo com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Status->getInsertID();
                $id = ((empty($id))?$this->request->data['Status']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o status, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
            
        }
        
        if($id != ""){
            $this->request->data = $this->Status->find('first',array('conditions' => array('id' => $id) , 'fields'=>array('id','nome')));
        }
        if($id!=NULL)$this->page_title = $this->Status->getField($id,'nome');
        $fildset = (($id==NULL)?"Novo status":"Editar status");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'nome' => array(),
                )
            );
        
            $this->set(
                        array(
                                'model'=>'Status',
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
        $lista = $this->getPaginate('Status', array('Status.nome') , array('id','nome'));
        $this->set(
                array(
                    'fields' => array('#'=>'Status.id','Nome'=>'Status.nome'),
                    'data' => $lista,
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Status->getField($id,'nome');
        $deletado = $this->Status->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("O status (".$nome.") foi deletado com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("O status (".$nome.") não pode ser deletado!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>