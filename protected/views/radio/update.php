<?php
/* @var $this RadioController */
/* @var $model Radio */

$this->breadcrumbs=array(
	'Radios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Radios', 'url'=>array('index')),
	array('label'=>'Crear Radio', 'url'=>array('create')),
	//array('label'=>'View Radio', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Radio', 'url'=>array('admin')),
);
?>

<h1>Actualizar Radio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>