<?php
/* @var $this MiembroController */
/* @var $model Miembro */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'banner-form',
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
        <?php echo $form->labelEx($model,'nombre'); ?>
        <?php echo $form->textField($model,'nombre',array('size'=>100,'maxlength'=>100,'class' => 'form-control')); ?>
        <?php echo $form->error($model,'nombre'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'imageUrl'); ?>
        <?php echo $form->fileField($model, 'imageUrl', array('class' => 'form-control', 'maxlength' => 350)); ?>
        <?php echo $form->error($model,'imageUrl'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'posicion'); ?>
        <?php echo $form->textField($model,'posicion',array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'posicion'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'biografia'); ?>
        <?php echo $form->textArea($model,'biografia',array('rows'=>6, 'cols'=>50,'class' => 'form-control')); ?>
        <?php echo $form->error($model,'biografia'); ?>
    </div>

    <footer class="panel-footer bg-light lter">
        <?php echo CHtml::link('Cancelar',array('miembro/'), array('class' => 'btn btn-default btn-s-xs')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary btn-s-xs')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->