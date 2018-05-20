<?php
/* @var $this PiscoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Piscos',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-plus"></i> Crear Pisco', 'url'=>array('create')),
	//array('label'=>'Manage Pisco', 'url'=>array('admin')),
);
?>

<h3>Piscos</h3>

<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>
