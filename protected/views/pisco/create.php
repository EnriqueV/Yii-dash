<?php
/* @var $this PiscoController */
/* @var $model Pisco */

$this->breadcrumbs=array(
	'Piscos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pisco', 'url'=>array('index')),
	//array('label'=>'Manage Pisco', 'url'=>array('admin')),
);
?>

<div class="panel-body">
    <h3 class="m0">Crear Pisco</h3>
</div>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>