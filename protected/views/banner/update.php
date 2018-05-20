<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Lista de Banners', 'url'=>array('index')),
	//array('label'=>'Create Banner', 'url'=>array('create')),
	//array('label'=>'View Banner', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Actualizar Banner</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>