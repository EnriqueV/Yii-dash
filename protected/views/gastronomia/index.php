<?php
/* @var $this GastronomiaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gastronomias',
);

$this->menu=array(
	array('label'=>'Crear Gastronomía', 'url'=>array('create')),
	//array('label'=>'Manage Gastronomia', 'url'=>array('admin')),
);
?>

<h1>Gastronomía</h1>

<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>
