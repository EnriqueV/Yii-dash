<?php
/* @var $this PiscoController */
/* @var $model Pisco */

$this->breadcrumbs=array(
	'Piscos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	//array('label'=>'Crear Pisco', 'url'=>array('create')),
	array('label'=>'Ver Pisco', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Pisco', 'url'=>array('admin')),
);
?>

<h3>Actualizar Pisco <?php echo "<b>".$model->name."</b>"; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>