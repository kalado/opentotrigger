<?php
class TopicoController extends AppController{
    
    /**
     * Adiciona ou Edita um novo topico
     */
    private function save($id=NULL , $serie_id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Topico->save($this->request->data);
            if($save!==FALSE){
                $this->Session->setFlash("O topico foi salvo com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Topico->getInsertID();
                $id = ((empty($id))?$this->request->data['Topico']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o topico, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
            
        }
        
        if($id != ""){
            $this->request->data = $this->Topico->find('first',array('conditions' => array($this->name.'.id' => $id) ));
        }
        if(!empty($serie_id)){
            $this->request->data['Topico']['serie_id'] = $serie_id;
        }else{
            $serie_id = $this->request->data['Topico']['serie_id'];
        }
        if($id!=NULL)$this->page_title = $this->Topico->getField($id,'nome');
        $fildset = (($id==NULL)?"Novo topico":"Editar topico");
        
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'serie_id' => array('type'=>'hidden'),
                    'nome' => array('label'=>'Nome'),
                    'idioma_id' => array('label'=>'Idioma','type'=>'select','options'=>$this->Idioma->getArraySimples('nome')),
                )
            );
        
            $this->set(
                        array(
                            'model' => 'Topico',
                            'campos' => $campos
                            )
                    );
            
            
            
            $this->set($this->Menus->MenuSerieADMIN($serie_id));
            $this->set($this->Menus->MenuNoticiasSerieADMIN($serie_id));
            
    }
    
    public function novo($serie_id){
        $this->beforeAdmin();
        $this->save(NULL,$serie_id);
        $this->render('save');
    }
    
    
    public function edit($id){
        $this->beforeAdmin();
        $this->save($id);
        $this->render('save');
    }
    
    
    public function lista(){
        $this->beforeAdmin();
        $lista = $this->getPaginate('Topico', array('Topico.nome') , array('id','nome','sigla'));
        $this->set(
                array(
                    'fields' => array('#'=>'Topico.id','Nome'=>'Topico.nome' , 'Sigla' => 'Topico.sigla'),
                    'data' => $lista,
                    'virtualFields' => array(),
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Topico->getField($id,'nome');
        $deletado = $this->Topico->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("O topico (".$nome.") foi deletado com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("O topico (".$nome.") não pode ser deletado!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>