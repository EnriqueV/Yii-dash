<?php
/* @var $this CategoriasNoticiaController */
/* @var $model CategoriasNoticia */

$this->breadcrumbs=array(
	'Categorias Noticias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoriasNoticia', 'url'=>array('index')),
	//array('label'=>'Manage CategoriasNoticia', 'url'=>array('admin')),
);
?>

<h1>Crear Categorias</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>