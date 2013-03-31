<?php
class InformacaoController extends AppController{
    
    /**
     * Adiciona ou Edita um novo tipo de usuário
     */
    private function save($id=NULL , $serie_id=NULL){
        if(!empty($this->request->data)){
            $save = $this->Informacao->save($this->request->data);
            if($save!==FALSE){
                $this->Session->setFlash("A Informacao foi salva com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Informacao->getInsertID();
                $id = ((empty($id))?$this->request->data['Informacao']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar a Informacao, favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
        }
        if($id != ""){
            $this->request->data = $this->Informacao->find('first',array('conditions' => array($this->name.'.id' => $id) ));
            $serie_id = $this->request->data['Topico']['serie_id'];
        }
        
        $topicos = array();
        $topicos_tmp = $this->Topico->getArraySimples('nome',  $this->Topico->find('all',array('conditions'=>array('Topico.serie_id'=>$serie_id))));
        foreach ($topicos_tmp as $id_topico => $label){
            $topicos[$id_topico] = $label." (".$this->Idioma->getField($this->Topico->getField($id_topico,'idioma_id'),'nome').")";
        }
        
        
        if($id!=NULL)$this->page_title = $this->Informacao->getField($id,'titulo');
        $fildset = (($id==NULL)?"Nova Informacao":"Editar Informacao");
        $campos = array(
                $fildset => array(
                    'id' => array('type'=>'hidden'),
                    'topico_id' => array('label'=>'Tópico da informação' , 'type'=>'select' , 'options' => $topicos,'class'=>'input-block-level'),
                    'titulo' => array('label'=>'Nome','required'=>TRUE,'class'=>'input-block-level'),
                    'conteudo' => array('type'=>'textarea-editor','class'=>'input-block-level'),
                ),
            );
            $this->set(
                        array(
                                'model'=>'Informacao',
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
        $lista = $this->getPaginate('Informacao', array('Informacao.nome') , array('id','nome'));
        $this->set(
                array(
                    'fields' => array('#'=>'Informacao.id','Nome'=>'Informacao.nome'),
                    'data' => $lista,
                    'virtualFields' => array(),
                )
        );
    }
    
    public function delete($id){
        $this->beforeAdmin();
        $nome = $this->Informacao->getField($id,'titulo');
        $serie_id = $this->Topico->getField($this->Informacao->getField($id,'topico_id'),'serie_id');
        
        
        
        $deletado = $this->Informacao->delete($id);
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
        $this->redirect(array('controller' => 'serie','action' => 'edit'),$serie_id);
    }
    
}

?>