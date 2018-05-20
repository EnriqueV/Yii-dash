<?php
/* @var $this CategoriasNoticiaController */
/* @var $model CategoriasNoticia */

$this->breadcrumbs=array(
	'Categorias Noticias'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Categorias', 'url'=>array('index')),
	//array('label'=>'Create CategoriasNoticia', 'url'=>array('create')),
	array('label'=>'View CategoriasNoticia', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage CategoriasNoticia', 'url'=>array('admin')),
);
?>

<h1>Actualizar Categoria</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>