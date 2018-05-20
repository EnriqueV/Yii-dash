<?php
/* @var $this CategoriasNoticiaController */
/* @var $model CategoriasNoticia */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categorias-noticia-form',
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
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>45,'maxlength'=>45, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

    <footer class="panel-footer bg-light lter">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class' => 'btn btn-primary btn-s-xs')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->