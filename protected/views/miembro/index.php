<?php
/* @var $this MiembroController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Miembros',
);

$this->menu=array(
	array('label'=>'Agregar Miembro', 'url'=>array('create')),
	//array('label'=>'Manage Miembro', 'url'=>array('admin')),
);
?>

<h3>Miembros</h3>

<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>
