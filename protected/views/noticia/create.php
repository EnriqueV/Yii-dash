<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	'Noticias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Noticia', 'url'=>array('index'))
);
?>

<h1>Crear Noticia</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>