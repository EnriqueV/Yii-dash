<?php
/* @var $this HorariosController */
/* @var $model Horarios */

$this->breadcrumbs=array(
	'Horarioses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Horarios', 'url'=>array('index')),
	//array('label'=>'Create Horarios', 'url'=>array('create')),
    array('label'=>'Regresar', 'url'=>array('pisco/horarios', 'id'=>$_GET["id"])),
	//array('label'=>'Manage Horarios', 'url'=>array('admin')),
);
?>

<h1>Editar Horarios dia <?php echo $model->dia; ?></h1>

<?php $this->renderPartial('_formHorario', array('model'=>$model)); ?>