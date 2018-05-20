<?php
/* @var $this CategoriasCuponesController */
/* @var $model CategoriasCupones */

$this->breadcrumbs=array(
	'Categorias Cupones'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Categorias', 'url'=>array('index')),
	//array('label'=>'Create CategoriasCupones', 'url'=>array('create')),
	//array('label'=>'View CategoriasCupones', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage CategoriasCupones', 'url'=>array('admin')),
);
?>

<h3>Editar Categoria</h3>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>