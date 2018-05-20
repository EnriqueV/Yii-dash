<?php
/* @var $this ContenidoController */
/* @var $model Contenido */

$this->breadcrumbs=array(
	'Contenidos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Contenidos', 'url'=>array('index')),
	//array('label'=>'Manage Contenido', 'url'=>array('admin')),
);
?>

<h3>Create Contenido</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>