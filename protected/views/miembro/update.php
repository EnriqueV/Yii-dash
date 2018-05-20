<?php
/* @var $this MiembroController */
/* @var $model Miembro */

$this->breadcrumbs=array(
	'Miembros'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Miembros', 'url'=>array('index')),
	//array('label'=>'Create Miembro', 'url'=>array('create')),
	//array('label'=>'View Miembro', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Miembro', 'url'=>array('admin')),
);
?>

<h1>Actualizar <?php echo $model->nombre; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>