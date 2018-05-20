<?php
/* @var $this BannerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Banners',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-plus"></i> Crear Banner', 'url'=>array('create'))
);
?>

<h3>Banners</h3>

<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>

