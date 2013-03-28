<?php echo $this->element('Admin/save');?>
<?php 
    if(isset($edit) && ($edit == TRUE)){
        echo $this->element('Utilitarios.save',array(
                                                    'model' => $model_link,
                                                    'campos' => $campos_link,
                                                    'botao_form' => array('label'=>"Adicionar Novo Link"),
                                                    )
                            );
        
        //echo $this->element('Utilitarios/form-links');
    }
?>