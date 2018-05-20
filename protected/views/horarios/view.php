<?php
/* @var $this HorariosController */
/* @var $model Horarios */

$this->breadcrumbs=array(
	'Horarioses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Horarios', 'url'=>array('index')),
	array('label'=>'Create Horarios', 'url'=>array('create')),
	array('label'=>'Update Horarios', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Horarios', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Horarios', 'url'=>array('admin')),
);
?>

<h1>View Horarios #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'dia',
		'horaInicial',
		'horaFinal',
		'piscoId',
	),
)); ?>
