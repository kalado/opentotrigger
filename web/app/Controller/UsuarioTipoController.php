<?php
class UsuarioTipoController extends AppController{
    
    /**
     * Adiciona ou Edita um novo tipo de usuário
     */
    private function save($id=NULL){
        if(!empty($this->request->data)){
            $save = $this->UsuarioTipo->save($this->request->data);
            
            if($save!==FALSE){
                $this->Session->setFlash("O tipo de usuário foi salvo com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->UsuarioTipo->getInsertID();
                $id = ((empty($id))?$this->request->data['UsuarioTipo']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o tipo de usuário, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
            
        }
        
        if($id != ""){
            $this->request->data = $this->UsuarioTipo->find('first',array('conditions' => array('id' => $id) , 'fields'=>array('id','nome','permissao')));
        }
        if($id==NULL)$this->page_title = $this->UsuarioTipo->getField($id,'nome');
        $fildset = (($id==NULL)?"Novo tipo de Usuário":"Editar tipo de usuário");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'nome' => array('label'=>'Nome'),
                    'permissao' => array('label'=>'Permissão'),
                )
            );
        
            $this->set(
                        array(
                                'model'=>'UsuarioTipo',
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
        $lista = $this->getPaginate('UsuarioTipo', array('UsuarioTipo.nome') , array('id','nome','permissao'));
        $this->set(
                array(
                    'fields' => array('#'=>'UsuarioTipo.id','Nome'=>'UsuarioTipo.nome' , 'Permissão' => 'UsuarioTipo.permissao'),
                    'data' => $lista,
                    'virtualFields' => array(),
                )
        );
    }
    
}

?>