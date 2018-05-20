<?php
/* @var $this GastronomiaController */
/* @var $model Gastronomia */

$this->breadcrumbs=array(
	'Gastronomias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Lista Gastronomia', 'url'=>array('index')),
	//array('label'=>'Manage Gastronomia', 'url'=>array('admin')),
);
?>

<h1>Crear Gastronomía</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>