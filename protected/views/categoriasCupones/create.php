<?php
/* @var $this CategoriasCuponesController */
/* @var $model CategoriasCupones */

$this->breadcrumbs=array(
	'Categorias Cupones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Categorias', 'url'=>array('index')),
	//array('label'=>'Manage CategoriasCupones', 'url'=>array('admin')),
);
?>

<h3>Crear Categoria</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>