<?php
/* @var $this HorariosController */
/* @var $model Horarios */

$this->breadcrumbs=array(
	'Horarioses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Horarios', 'url'=>array('index')),
	array('label'=>'Manage Horarios', 'url'=>array('admin')),
);
?>

<h1>Create Horarios</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>