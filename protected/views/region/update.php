<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Lista de regiones', 'url'=>array('index')),
	array('label'=>'Crear Region', 'url'=>array('create')),
	//array('label'=>'View Region', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Region', 'url'=>array('admin')),
);
?>

<h1>Editar Region</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>