<?php
class MultimidiaController extends AppController{
    
    /**
     * Adiciona ou Edita um novo tipo de usuário
     */
    private function save($id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Multimidia->save($this->request->data);
            if($save!==FALSE){
                $this->Session->setFlash("A Multimidia foi salva com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Multimidia->getInsertID();
                $id = ((empty($id))?$this->request->data['Multimidia']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar a Multimidia, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
        }
        if($id != ""){
            $this->request->data = $this->Multimidia->find('first',array('conditions' => array('id' => $id) , 'fields'=>array('id','nome','unidade')));
            if(!empty ($this->request->data['Qualidades'])){
                foreach ( $this->request->data['Qualidades'] as $compativeis){
                    $qualidades_compativeis[] = $compativeis['id'];
                }
            }else{
                $qualidades_compativeis = array();
            }
            $this->request->data['Multimidia']['formatos_aceitos'] = $qualidades_compativeis;
        }
        if($id!=NULL)$this->page_title = $this->Multimidia->getField($id,'nome');
        $fildset = (($id==NULL)?"Nova Multimidia":"Editar Multimidia");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'nome' => array('label'=>'Nome','required'=>TRUE),
                    'unidade' => array('label'=>'Nome da unidade','required'=>TRUE),
                    'formatos_aceitos' => array('label'=>'Formatos Aceitos' , 'type'=>'select-multiple' , 'options' => $this->Qualidade->getArraySimples('sigla')),
                ),
            );
            $this->set(
                        array(
                                'model'=>'Multimidia',
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
        $lista = $this->getPaginate('Multimidia', array('Multimidia.nome') , array('id','nome'));
        $this->set(
                array(
                    'fields' => array('#'=>'Multimidia.id','Nome'=>'Multimidia.nome'),
                    'data' => $lista,
                    'virtualFields' => array(),
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Multimidia->getField($id,'nome');
        $deletado = $this->Multimidia->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("A multimidia (".$nome.") foi deletada com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("A multimidia (".$nome.") não pode ser deletada!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>