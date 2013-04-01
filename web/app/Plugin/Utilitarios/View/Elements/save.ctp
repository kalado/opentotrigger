<?php echo $this->Session->flash(); ?>
<?php 
if(!isset($botao_form)){
    $botao_form = array('label'=>'Salvar');
}
?>
<?php echo $this->FormGen->gerarFormulario($model,array('class'=>'horizontal','type' => 'file'), $campos , $botao_form); ?>















