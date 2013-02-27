<?php
class QualidadeController extends AppController{
    
    /**
     * Adiciona ou Edita uma nova qualidade
     */
    private function save($id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Qualidade->save($this->request->data);
            
            if($save!==FALSE){
                $this->Session->setFlash("A qualidade foi salva com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Qualidade->getInsertID();
                $id = ((empty($id))?$this->request->data['Qualidade']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar a qualidade, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
        }
        
        if($id != ""){
            $this->request->data = $this->Qualidade->find('first',array('conditions' => array('id' => $id) , 'fields'=>array('id','sigla','nome','nota')));
        }
        if($id!=NULL)$this->page_title = $this->Qualidade->getField($id,'nome');
        $fildset = (($id==NULL)?"Nova Qualidade":"Editar Qualidade");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'nome' => array('required'=>TRUE),
                    'sigla' => array(),
                    'nota' => array('type'=>'select' , 'options' => array(1,2,3,4,5,6,7,8,9,10) ),
                )
            );
        
            $this->set(
                        array(
                                'model' => 'Qualidade',
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
        $lista = $this->getPaginate('Qualidade', array('Qualidade.nome') , array('id','nome','sigla','nota'));
        $this->set(
                array(
                    'fields' => array('#'=>'Qualidade.id','Nome'=>'Qualidade.nome' , 'Sigla' => 'Qualidade.sigla' , 'Nota'=>'Qualidade.nota'),
                    'data' => $lista,
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Qualidade->getField($id,'nome');
        $deletado = $this->Qualidade->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("A qualidade (".$nome.") foi deletada com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("A qualidade (".$nome.") não pode ser deletada!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>