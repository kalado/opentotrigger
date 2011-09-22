<?php
$this->breadcrumbs=array(
	'Idiomas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Lista Idioma', 'url'=>array('index')),
	array('label'=>'Gerenciar Idioma', 'url'=>array('admin')),
);
?>

<h1>Criar Idioma</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>