<?php
/* @var $this GastronomiaController */
/* @var $model Gastronomia */

$this->breadcrumbs=array(
	'Gastronomias'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Lista Gastronomia', 'url'=>array('index')),
	/*array('label'=>'Create Gastronomia', 'url'=>array('create')),
	array('label'=>'View Gastronomia', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Gastronomia', 'url'=>array('admin')),*/
);
?>

<h1>Actualizar <?php echo $model->titulo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>