<?php
/* @var $this CuponesCodigosGeneradosController */
/* @var $model CuponesCodigosGenerados */

$this->breadcrumbs=array(
	'Cupones Codigos Generadoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CuponesCodigosGenerados', 'url'=>array('index')),
	array('label'=>'Manage CuponesCodigosGenerados', 'url'=>array('admin')),
);
?>

<h1>Create CuponesCodigosGenerados</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>