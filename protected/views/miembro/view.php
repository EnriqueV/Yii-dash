<?php
/* @var $this MiembroController */
/* @var $model Miembro */

$this->breadcrumbs=array(
	'Miembros'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Miembro', 'url'=>array('index')),
	array('label'=>'Create Miembro', 'url'=>array('create')),
	array('label'=>'Update Miembro', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Miembro', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Miembro', 'url'=>array('admin')),
);
?>

<h1>View Miembro #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'imageUrl',
	),
)); ?>
