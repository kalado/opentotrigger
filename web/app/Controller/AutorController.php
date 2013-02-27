<?php
class AutorController extends AppController{
    
    /**
     * Adiciona ou Edita um novo autor
     */
    private function save($id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Autor->save($this->request->data);
            if($save!==FALSE){
                $this->Session->setFlash("O autor foi salvo com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Autor->getInsertID();
                $id = ((empty($id))?$this->request->data['Autor']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o autor, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
            
        }
        
        if($id != ""){
            $this->request->data = $this->Autor->find('first',array('conditions' => array('id' => $id) , 'fields'=>array('id','nome')));
        }
        
        if($id!=NULL)$this->page_title = $this->Autor->getField($id,'nome');
        $fildset = (($id==NULL)?"Novo autor":"Editar autor");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'nome' => array(),
                )
            );
        
            $this->set(
                        array(
                                'model'=>'Autor',
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
        $lista = $this->getPaginate('Autor', array('Autor.nome') , array('id','nome'));
        $this->set(
                array(
                    'fields' => array('#'=>'Autor.id','Nome'=>'Autor.nome'),
                    'data' => $lista,
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Autor->getField($id,'nome');
        $deletado = $this->Autor->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("O autor (".$nome.") foi deletado com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("O autor (".$nome.") não pode ser deletado!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>