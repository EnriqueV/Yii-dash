<?php
/* @var $this PiscoController */
/* @var $model CuponesDescuento */

$this->breadcrumbs=array(
    'Miembros'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'Regresar', 'url'=>array('cupones','id'=>$model->pisco->id)),
    //array('label'=>'Manage Miembro', 'url'=>array('admin')),
);
?>

<h1>Actualizar Cupón</h1>

<?php $this->renderPartial('_formCuponDescuento', array('model'=>$model)); ?>