<?php
class IdiomaController extends AppController{
    
    /**
     * Adiciona ou Edita um novo idioma
     */
    private function save($id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Idioma->save($this->request->data);
            if($save!==FALSE){
                $this->Session->setFlash("O idioma foi salvo com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Idioma->getInsertID();
                $id = ((empty($id))?$this->request->data['Idioma']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o idioma, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
            
        }
        
        if($id != ""){
            $this->request->data = $this->Idioma->find('first',array('conditions' => array('id' => $id) , 'fields'=>array('id','nome','sigla')));
        }
        
        if($id!=NULL)$this->page_title = $this->Idioma->getField($id,'nome');
        $fildset = (($id==NULL)?"Novo idioma":"Editar idioma");
        
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'nome' => array('label'=>'Nome'),
                    'sigla' => array(),
                )
            );
        
            $this->set(
                        array(
                            'model' => 'Idioma',
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
        $lista = $this->getPaginate('Idioma', array('Idioma.nome') , array('id','nome','sigla'));
        $this->set(
                array(
                    'fields' => array('#'=>'Idioma.id','Nome'=>'Idioma.nome' , 'Sigla' => 'Idioma.sigla'),
                    'data' => $lista,
                    'virtualFields' => array(),
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Idioma->getField($id,'nome');
        $deletado = $this->Idioma->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("O idioma (".$nome.") foi deletado com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("O idioma (".$nome.") não pode ser deletado!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>