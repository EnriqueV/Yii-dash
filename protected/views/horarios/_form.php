<?php
/* @var $this HorariosController */
/* @var $model Horarios */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'horarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'dia'); ?>
		<?php echo $form->textField($model,'dia',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'dia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'horaInicial'); ?>
		<?php echo $form->textField($model,'horaInicial',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'horaInicial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'horaFinal'); ?>
		<?php echo $form->textField($model,'horaFinal',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'horaFinal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'piscoId'); ?>
		<?php echo $form->textField($model,'piscoId'); ?>
		<?php echo $form->error($model,'piscoId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->