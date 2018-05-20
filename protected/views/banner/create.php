<?php
/* @var $this BannerController */
/* @var $model Banner */

$this->breadcrumbs=array(
	'Banners'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Lista de Banners', 'url'=>array('index')),
);
?>

<h1>Crear Banner</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>