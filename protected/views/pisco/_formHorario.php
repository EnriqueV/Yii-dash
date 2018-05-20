<?php
/* @var $this HorariosController */
/* @var $model Horarios */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'horarios-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class='col-sm-2'>
    <div class="form-group">
		<?php echo $form->labelEx($model,'horaInicial'); ?>
        <div class='input-group date' id='datetimepicker3'>
		<?php echo $form->textField($model,'horaInicial',array('size'=>45,'maxlength'=>45,"class"=>"form-control datetimepicker")); ?>
            <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
        </div>
		<?php echo $form->error($model,'horaInicial'); ?>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'horaFinal'); ?>
        <div class='input-group date' id='datetimepicker3'>
		<?php echo $form->textField($model,'horaFinal',array('size'=>45,'maxlength'=>45,"class"=>"form-control datetimepicker")); ?>
        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
        </div>
        <?php echo $form->error($model,'horaFinal'); ?>
	</div>

    <footer class="panel-footer bg-light lter">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar',array('class' => 'btn btn-primary btn-s-xs')); ?>
	</div>
</div>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->