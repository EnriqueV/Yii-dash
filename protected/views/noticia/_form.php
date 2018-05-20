<?php
/* @var $this NoticiaController */
/* @var $model Noticia */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'noticia-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data')

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
		<?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>75, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

    <div class="form-group">
		<?php //echo $form->labelEx($model,'fecha'); ?>
		<?php //echo $form->textField($model,'fecha',array('class' => 'form-control datepicker-input', 'maxlength' => 75, 'data-date-format' => 'yyyy-mm-dd')); ?>
		<?php //echo $form->error($model,'fecha'); ?>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'categoriaId'); ?>
		<?php //echo $form->textField($model,'categoriaId',array('class' => 'form-control')); ?>
		<?php echo $form->dropDownList($model,'categoriaId',CHtml::listData(CategoriasNoticia::model()->findAll(),'id','nombre'),array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'categoriaId'); ?>
	</div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'imageUrl'); ?>
        <?php echo $form->fileField($model, 'imageUrl', array('class' => 'form-control', 'maxlength' => 75)); ?>
        <?php echo $form->error($model,'imageUrl'); ?>
    </div>

    <footer class="panel-footer bg-light lter">
        <?php echo CHtml::link('Cancelar',array('noticia/'), array('class' => 'btn btn-default btn-s-xs')); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class' => 'btn btn-primary btn-s-xs')); ?>
    </footer>

<?php $this->endWidget(); ?>

</div><!-- form -->