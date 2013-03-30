<?php echo $this->element('Admin/save');?>
<?php 
    if(isset($edit) && ($edit == TRUE)){
        
        echo $this->FormGen->gerarFormulario($model_link,array('class'=>'horizontal' , 'url' => array('controller' => 'link', 'action' => 'novo')), $campos_link , array('label'=>"Adicionar Novo Link"));
        
        echo $this->element('Utilitarios.lista');
    }
?>