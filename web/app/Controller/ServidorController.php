<?php
class ServidorController extends AppController{
    
    /**
     * Adiciona ou Edita um novo servidor
     */
    private function save($id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Servidor->save($this->request->data);
            
            if($save!==FALSE){
                $this->Session->setFlash("O Servidor foi salvo com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Servidor->getInsertID();
                $id = ((empty($id))?$this->request->data['Servidor']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o servidor, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
            
        }
        
        if($id != ""){
            $this->request->data = $this->Servidor->find('first',array('conditions' => array('id' => $id) , 'fields'=>array('id','nome','habilitado','usuario','senha')));
        }
        if($id!=NULL)$this->page_title = $this->Servidor->getField($id,'nome');
        $fildset = (($id==NULL)?"Novo Servidor":"Editar servidor");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'nome' => array('label'=>'Nome','required'=>TRUE),
                    'habilitado' => array('type'=>'radio' , 'options'=>array('1' => 'Ativado', '0' => 'Desativado') , 'value'=>'1'),
                ),
                'Adicionais' => array(
                    'usuario' => array('label'=>'Usuário'),
                    'senha' => array(),
                )
            );
        
            $this->set(
                        array(
                                'model'=>'Servidor',
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
        $lista = $this->getPaginate('Servidor', array('Servidor.nome') , array('id','nome','habilitado'));
        $this->set(
                array(
                    'fields' => array('#'=>'Servidor.id','Nome'=>'Servidor.nome' , 'Ativado' => 'Servidor.habilitado'),
                    'data' => $lista,
                    'virtualFields' => array("Servidor.habilitado"=>array("1"=>"Sim","0"=>"Não")),
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Servidor->getField($id,'nome');
        $deletado = $this->Servidor->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("O servidor (".$nome.") foi deletado com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("O servidor (".$nome.") não pode ser deletado!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>