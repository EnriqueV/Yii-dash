<?php
/* @var $this NoticiaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Noticias',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-plus"></i> Crear Noticia', 'url'=>array('create')),
	//array('label'=>'Manage Noticia', 'url'=>array('admin')),
);
?>

<h3>Noticias</h3>

<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>
