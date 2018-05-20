<?php
/* @var $this HorariosController */
/* @var $model Horarios */

$this->breadcrumbs=array(
	'Horarioses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Horarios', 'url'=>array('index')),
	array('label'=>'Create Horarios', 'url'=>array('create')),
	array('label'=>'View Horarios', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Horarios', 'url'=>array('admin')),
);
?>

<h1>Update Horarios <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>