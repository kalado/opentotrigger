<?php
class SerieController extends AppController{
    
    /**
     * Adiciona ou Edita uma nova serie
     */
    
    private function save($id=NULL){
        if(!empty($this->request->data)){
            $id = ((empty($id))?FALSE:$id); 
            if($id!=FALSE){
                $foto = $this->Serie->getField($id,'imagem');
                $this->request->data['Serie']['imagem'] = $this->Arquivo->upload($this->name);
            }else{
                $this->request->data['Serie']['imagem'] = $this->Arquivo->upload($this->name);
                $foto = $this->request->data['Serie']['imagem'];
            }
            
            $save = $this->Serie->save($this->request->data);
            if($save!==FALSE){
                if($id!=false){
                    $this->Arquivo->deletar($foto);
                }
                $this->Session->setFlash("A serie foi salva com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Serie->getInsertID();
                $id = (($id == false)?$this->request->data['Serie']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Arquivo->deletar($foto);
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar a serie, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
        }
        if($id != ""){
            $this->request->data = $this->Serie->find('first',array('conditions' => array($this->name.'.id' => $id) ));
            if(!empty ($this->request->data['Autoria'])){
                foreach ( $this->request->data['Autoria'] as $autor){
                    $autores[] = $autor['id'];
                }
            }else{
                $autores = array();
            }
            $this->request->data['Serie']['autores'] = array_map("intval", $autores);
            
            
            
            if(!empty ($this->request->data['Generos'])){
                foreach ( $this->request->data['Generos'] as $genero){
                    $generos[] = $genero['id'];
                }
            }else{
                $generos = array();
            }
            $this->request->data['Serie']['generos'] = array_map("intval", $generos);
            
            
            
            $this->set($this->Menus->MenuSerieADMIN($id));
            $this->set($this->Menus->MenuNoticiasSerieADMIN($id));
            $this->set($this->Menus->MenuTopADMIN('serie',$id));
        }
        if($id!=NULL)$this->page_title = $this->Serie->getField($id,'nome');
        $fildset = (($id==NULL)?"Nova Serie":"Editar Serie");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'nome' => array('required'=>TRUE , 'class'=>'input-block-level'),
                    'sinopse' => array('type'=>'textarea-editor'),
                    'imagem' => array( 'type'=>'file' , 'class'=>'input-block-level'),
                    'status_id' => array('label'=>'Status','type'=>'select','options'=>$this->Status->getArraySimples('nome'),'class'=>'input-block-level'),
                    'autores' => array('label'=>'Autores' , 'type'=>'checkbox-inline', 'options' => $this->Autor->getArraySimples('nome')),
                    'generos' => array('label'=>'Generos' , 'type'=>'checkbox-inline', 'options' => $this->Genero->getArraySimples('nome')),
                )
            );
        
            $this->set(
                        array(
                                'model' => 'Serie',
                                'campos' => $campos,
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
        $lista = $this->getPaginate('Serie', array('Serie.nome') , array('id','nome'));
        $this->set(
                array(
                    'fields' => array('#'=>'Serie.id','Nome'=>'Serie.nome'),
                    'data' => $lista,
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Serie->getField($id,'nome');
        $deletado = $this->Serie->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("A serie (".$nome.") foi deletada com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("A serie (".$nome.") não pode ser deletada!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>