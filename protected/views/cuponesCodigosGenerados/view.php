<?php
/* @var $this CuponesCodigosGeneradosController */
/* @var $model CuponesCodigosGenerados */

$this->breadcrumbs=array(
	'Cupones Codigos Generadoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CuponesCodigosGenerados', 'url'=>array('index')),
	array('label'=>'Create CuponesCodigosGenerados', 'url'=>array('create')),
	array('label'=>'Update CuponesCodigosGenerados', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CuponesCodigosGenerados', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CuponesCodigosGenerados', 'url'=>array('admin')),
);
?>

<h1>View CuponesCodigosGenerados #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'codigo',
		'cupon_descuento_id',
		'userId',
	),
)); ?>
