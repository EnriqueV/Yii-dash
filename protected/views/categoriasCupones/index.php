<?php
/* @var $this CategoriasCuponesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categorias Cupones',
);

$this->menu=array(
	array('label'=>'Crear Categoria', 'url'=>array('create')),
	//array('label'=>'Manage CategoriasCupones', 'url'=>array('admin')),
);
if($msj){
    echo "<script>alert('".$msj."');</script>";
}
?>

<h3>Categorias Cupones</h3>

<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>
