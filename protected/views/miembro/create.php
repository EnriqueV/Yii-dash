<?php
/* @var $this MiembroController */
/* @var $model Miembro */

$this->breadcrumbs=array(
	'Miembros'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Regresar', 'url'=>array('index')),
	//array('label'=>'Manage Miembro', 'url'=>array('admin')),
);
?>

<h1>Create Miembro</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>