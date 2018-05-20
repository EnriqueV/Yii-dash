<?php
/* @var $this RegionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Regions',
);

$this->menu=array(
	array('label'=>'Crear Region', 'url'=>array('create')),
	//array('label'=>'Manage Region', 'url'=>array('admin')),
);

if($msj){
    echo "<script>alert('".$msj."');</script>";
}
?>

<h1>Regiones</h1>

<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>
