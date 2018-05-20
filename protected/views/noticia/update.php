<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	'Noticias'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Noticias', 'url'=>array('index')),
	array('label'=>'Crear Noticia', 'url'=>array('create')),
	array('label'=>'Ver Noticia', 'url'=>array('view', 'id'=>$model->id))
);
?>

<h1>Actualizar Noticia</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>