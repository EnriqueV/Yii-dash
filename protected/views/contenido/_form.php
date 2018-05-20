<?php
/* @var $this ContenidoController */
/* @var $model Contenido */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contenido-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php
    if ($model->getErrors()) {
        ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-ban-circle"></i>
            <?php echo $form->errorSummary($model); ?>
        </div>
    <?php
    }
    ?>

    <div class="form-group">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>65,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'texto'); ?>
		<?php echo $form->textArea($model,'texto',array('rows'=>6, 'cols'=>50,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'texto'); ?>
	</div>

    <div class="form-group">
		<?php //echo $form->labelEx($model,'tipo'); ?>
		<?php //echo $form->textField($model,'tipo',array('size'=>60,'maxlength'=>150,'class' => 'form-control')); ?>
		<?php //echo $form->error($model,'tipo'); ?>
	</div>

    <footer class="panel-footer bg-light lter">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class' => 'btn btn-primary btn-s-xs')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->