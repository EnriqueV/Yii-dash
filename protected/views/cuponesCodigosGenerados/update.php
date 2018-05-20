<?php
/* @var $this CuponesCodigosGeneradosController */
/* @var $model CuponesCodigosGenerados */

$this->breadcrumbs=array(
	'Cupones Codigos Generadoses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CuponesCodigosGenerados', 'url'=>array('index')),
	array('label'=>'Create CuponesCodigosGenerados', 'url'=>array('create')),
	array('label'=>'View CuponesCodigosGenerados', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CuponesCodigosGenerados', 'url'=>array('admin')),
);
?>

<h1>Update CuponesCodigosGenerados <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>