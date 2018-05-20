<?php
/* @var $this ContenidoController */
/* @var $model Contenido */

$this->breadcrumbs=array(
	'Contenidos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Contenidos', 'url'=>array('index')),
	//array('label'=>'Create Contenido', 'url'=>array('create')),
	//array('label'=>'View Contenido', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Contenido', 'url'=>array('admin')),
);
?>

<h3>Actualizar contenido</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>