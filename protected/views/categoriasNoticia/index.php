<?php
/* @var $this CategoriasNoticiaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categorias Noticias',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-plus"></i> Crear Categoria ', 'url'=>array('create')),
	//array('label'=>'Manage CategoriasNoticia', 'url'=>array('admin')),
);
?>

<h3>Categorias</h3>

<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>