<?php
class CapituloController extends AppController{
    
    /**
     * Adiciona ou Edita um novo capitulo
     */
    private function save($id=NULL,$anime_id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Capitulo->save($this->request->data);
            
            if($save!==FALSE){
                $this->Session->setFlash("O Capitulo foi salvo com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Capitulo->getInsertID();
                $id = ((empty($id))?$this->request->data['Capitulo']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o capitulo, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
            
        }
        
        if($id != ""){
            $this->request->data = $this->Capitulo->find('first',array('conditions' => array('id' => $id) , 'fields'=>array('id','nome','habilitado','usuario','senha')));
        }else{
            $this->request->data['Capitulo']['anime_id'] = $anime_id;
        }
        if($id!=NULL)$this->page_title = $this->Capitulo->getField($id,'nome');
        $fildset = (($id==NULL)?"Novo Capitulo":"Editar capitulo");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'anime_id' => array('type'=>'hidden'),
                    'titulo' => array('required'=>TRUE),
                    'numero' => array('label'=>'Número'),
                )
            );
        
            $this->set(
                        array(
                                'model'=>'Capitulo',
                                'campos' => $campos
                            )
                    );
    }
    
    public function novo($anime_id){
        $this->beforeAdmin();
        $this->save(NULL,$anime_id);
        $this->render('save');
    }
    
    
    public function edit($id){
        $this->beforeAdmin();
        $this->save($id);
        
        $this->render('save');
    }
    
    
    public function lista(){
        $this->beforeAdmin();
        $lista = $this->getPaginate('Capitulo', array('Capitulo.nome') , array('id','nome','habilitado'));
        $this->set(
                array(
                    'fields' => array('#'=>'Capitulo.id','Nome'=>'Capitulo.nome' , 'Ativado' => 'Capitulo.habilitado'),
                    'data' => $lista,
                    'virtualFields' => array("Capitulo.habilitado"=>array("1"=>"Sim","0"=>"Não")),
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Capitulo->getField($id,'nome');
        $deletado = $this->Capitulo->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("O capitulo (".$nome.") foi deletado com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("O capitulo (".$nome.") não pode ser deletado!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>