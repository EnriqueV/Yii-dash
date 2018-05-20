<?php
/* @var $this ContenidoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contenidos',
);

$this->menu=array(
	array('label'=>'Create Contenido', 'url'=>array('create')),
	array('label'=>'Manage Contenido', 'url'=>array('admin')),
);
?>

<h3>Contenidos</h3>

<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>
