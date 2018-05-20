<?php
/* @var $this CuponesCodigosGeneradosController */
/* @var $model CuponesCodigosGenerados */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cupones-codigos-generados-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php if($form->errorSummary($model)){ ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="fa fa-ban-circle"></i><strong>Oh snap!</strong>
            <?php echo $form->errorSummary($model); ?>
        </div>
    <?php } ?>

    <div class="form-group">
		<?php echo $form->labelEx($model,'codigo'); ?>
		<?php echo $form->textField($model,'codigo',array('size'=>60,'maxlength'=>75,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'codigo'); ?>
	</div>

    <footer class="panel-footer bg-light lter">
		<?php echo CHtml::submitButton('Consultar', array('class' => 'btn btn-primary btn-s-xs')); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
         if($model->codigo AND $codigoEncontrado AND $codigoEncontrado[0]){
             echo CHtml::submitButton('Canjear', array('class' => 'btn btn-info btn-s-xs','onClick'=>'return confirm("Está seguro de realizar esta operacion?");'));
         }

         ?>
	</footer>

<?php $this->endWidget(); ?>

</div><!-- form -->