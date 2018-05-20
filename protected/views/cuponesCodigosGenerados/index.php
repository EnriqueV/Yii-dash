<?php
/* @var $this CuponesCodigosGeneradosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Consultar de cupón',
);

/*$this->menu=array(
	array('label'=>'Create CuponesCodigosGenerados', 'url'=>array('create')),
	array('label'=>'Manage CuponesCodigosGenerados', 'url'=>array('admin')),
);*/
?>

<h3>Consultar un cupón</h3>

<?php $this->renderPartial('_form_canjear', array('model'=>$model,'codigoEncontrado'=>$codigoEncontrado)); ?>
<?php

if ($codigoEncontrado) {
    $exito = $codigoEncontrado[0];
    $mensaje = $codigoEncontrado[1];
    if ($exito) {
        ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="fa fa-ban-circle"></i>
            <?php echo $mensaje; ?>
        </div>
    <?php
    } else {
        ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="fa fa-ban-circle"></i><strong></strong>
            <?php echo $mensaje; ?>
        </div>
    <?php
    }
}
?>
