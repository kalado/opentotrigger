<?php
$this->breadcrumbs=array(
	'Idiomas',
);

$this->menu=array(
	array('label'=>'Criar Idiomas', 'url'=>array('create')),
	array('label'=>'Gerenciar Idiomas', 'url'=>array('admin')),
);
?>

<h1>Idiomas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>