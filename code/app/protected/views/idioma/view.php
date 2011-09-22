<?php
$this->breadcrumbs=array(
	'Idioma'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Listar Idioma', 'url'=>array('index')),
	array('label'=>'Criar Idioma', 'url'=>array('create')),
	array('label'=>'Atualizar Idioma', 'url'=>array('update', 'id'=>$model->_id)),
	array('label'=>'Deletar Idioma', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gerenciar Idioma', 'url'=>array('admin')),
);
?>

<h1>View Idioma #<?php echo $model->_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idioma',
	),
)); ?>