<?php
class CapituloController extends AppController{
    
    /**
     * Adiciona ou Edita um novo capitulo
     */
    private function save($id=NULL,$anime_id=NULL,$serie_id=NULL){
        $mateiral_nome = "capitulo";
        if(!empty($anime_id)){
            $multimidia_id = $this->Anime->getField($anime_id,'multimidia_id');
        }else if(!empty ($id)){
            $multimidia_id = $this->Anime->getField($this->Capitulo->getField($id,'anime_id'),'multimidia_id');
        }
        if(isset($multimidia_id)){
            $mateiral_nome = $this->Multimidia->getField($multimidia_id,'unidade');
        }
        if(!empty($this->request->data)){
            $save = $this->Capitulo->save($this->request->data);
            
            if($save!==FALSE){
                $this->Session->setFlash("O ".ucfirst($mateiral_nome)." foi salvo com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));
                $id = $this->Capitulo->getInsertID();
                $id = ((empty($id))?$this->request->data['Capitulo']['id']:$id); 
                $this->redirect(array('controller' => $this->name, 'action' => 'edit' , $id ));
            }else{
                $this->Session->setFlash("Ocorreu um erro na tentativa de salvar o ".ucfirst($mateiral_nome).", favor conferir os dados e tentar novamente!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
            }
            
        }
        if($id != ""){
            $this->request->data = $this->Capitulo->find('first',array('conditions' => array($this->name.'.id' => $id)));
            if(empty($serie_id)){
                $serie_id = $this->Anime->getField($this->request->data['Capitulo']['anime_id'],'serie_id');
            }
        }else{
            if(!empty($anime_id)){
                $this->request->data['Capitulo']['anime_id'] = $anime_id;
            }
            if(empty($serie_id)){
                $serie_id = $this->Anime->getField($anime_id,'serie_id');
            }
        }
        if($id!=NULL)$this->page_title = $this->Capitulo->getField($id,'titulo');
        $fildset = (($id==NULL)?"Novo ".ucfirst($mateiral_nome)."":"Editar ".ucfirst($mateiral_nome)."");
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
            if(!empty($serie_id)){
                $this->set($this->Menus->MenuSerieADMIN($serie_id));
            }
            if(!empty($this->request->data['Capitulo']['anime_id'])){
                $this->set($this->Menus->MenuEpisodiosADMIN($this->request->data['Capitulo']['anime_id']));
            }
    }
    
    public function novo($anime_id){
        $this->beforeAdmin();
        $this->save(NULL,$anime_id);
        $this->render('save');
    }
    
    
    public function edit($id){
        $this->beforeAdmin();
        $this->save($id);
        
        
        $capitulos = $this->Capitulo->find('first',array('conditions' => array($this->name.'.id' => $id), 'recursive' => 3));
        $qualidades_aceitas = $capitulos['Anime']['Multimidia']['Qualidades'];
        
        $qualidades_aceitas_options = array();
        foreach($qualidades_aceitas as $qualidade){
            $qualidades_aceitas_options[$qualidade['id']]=$qualidade['sigla'];
        }
        
        $campos = array(
            'Novo Link' => array(
                'capitulo_id' => array('type'=>'hidden','value'=>$id),
                'url' => array('required'=>TRUE),
                'servidor_id' => array('label'=>'Servidor','type'=>'select','options'=>$this->Servidor->getArraySimples('nome')),
                'qualidade_id' => array('label'=>'Qualidade','type'=>'select','options'=>$qualidades_aceitas_options),
            )
        );
        $this->set(
                    array(
                            'model_link'=>'Link',
                            'campos_link' => $campos
                        )
                );
        
        
        
        
        $this->set('edit',TRUE);
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
    
    public function delete($id , $anime_id = NULL){
        $this->beforeAdmin();
        $nome = $this->Capitulo->getField($id,'titulo');
        $nome_unidade = strtolower($this->Multimidia->getField($this->Anime->getField($this->Capitulo->getField($id,'anime_id'),'multimidia_id'),'unidade'));
        
        $deletado = $this->Capitulo->delete($id);
        if($deletado==TRUE){
            $this->Session->setFlash("O ".$nome_unidade." (".$nome.") foi deletado com sucesso!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-success'
                ));            
        }else{
            $this->Session->setFlash("O ".$nome_unidade." (".$nome.") não pode ser deletado!", 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));            
        }
        if(!empty($anime_id)){
            $this->redirect(array('controller' => 'anime','action' => 'edit',$anime_id));
        }
        $this->redirect(array('action' => 'lista'));
    }
    
}

?>