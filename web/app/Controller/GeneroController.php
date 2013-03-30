<?php
class GeneroController extends AppController{
    
    /**
     * Adiciona ou Edita um novo genero
     */
    private function save($id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Genero->save($this->request->data);
            if($save!==FALSE){
                $this->Session->setFlash("O Genero foi salvo com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Genero->getInsertID();
                $id = ((empty($id))?$this->request->data['Genero']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o genero, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
            
        }
        
        if($id != ""){
            $this->request->data = $this->Genero->find('first',array('conditions' => array('id' => $id)));
        }
        if($id!=NULL)$this->page_title = $this->Genero->getField($id,'nome');
        $fildset = (($id==NULL)?"Novo Genero":"Editar Genero");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'nome' => array('label'=>'Nome','required'=>TRUE),
                )
            );
        
            $this->set(
                        array(
                                'model'=>'Genero',
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
        $lista = $this->getPaginate('Genero', array('Genero.nome'));
        $this->set(
                array(
                    'fields' => array('#'=>'Genero.id','Nome'=>'Genero.nome'),
                    'data' => $lista,
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Genero->getField($id,'nome');
        $deletado = $this->Genero->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("O genero (".$nome.") foi deletado com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("O genero (".$nome.") não pode ser deletado!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>