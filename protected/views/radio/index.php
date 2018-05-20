<?php
/* @var $this RadioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Radios',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-plus"></i> Crear Radio', 'url'=>array('create')),
	//array('label'=>'Manage Radio', 'url'=>array('admin')),
);
?>

<h3>Radios</h3>

<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>
