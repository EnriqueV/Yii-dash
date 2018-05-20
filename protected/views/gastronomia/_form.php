<?php
/* @var $this GastronomiaController */
/* @var $model Gastronomia */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gastronomia-form',
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

    <!--<div class="form-group">
		<?php /*echo $form->labelEx($model,'piscoId'); */?>
		<?php /*echo $form->textField($model,'piscoId'); */?>
		<?php /*echo $form->error($model,'piscoId'); */?>
	</div>-->
    <div class="form-group">
        <?php echo $form->labelEx($model, 'piscoId'); ?><br>
        <select style="width:500px" class="chosen-select form-control" name="Gastronomia[piscoId]">
            <option value="">Seleccinar..</option>
            <?php foreach (Pisco::model()->findAll(array("condition"=>"userId =".Yii::app()->user->id)) as $pisco) { ?>
                <option value="<?php echo $pisco->id; ?>" <?php if ($model->piscoId == $pisco->id) { echo "selected";
                } ?>><?php echo $pisco->name; ?></option>
            <?php } ?>
        </select>
        <?php echo $form->error($model, 'userId'); ?>
    </div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('size'=>50,'maxlength'=>50,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'imageUrl'); ?>
        <?php echo $form->fileField($model, 'imageUrl', array('class' => 'form-control', 'maxlength' => 100)); ?>
        <?php echo $form->error($model,'imageUrl'); ?>
    </div>

    <footer class="panel-footer bg-light lter">
        <?php echo CHtml::link('Cancelar',array('gastronomia/'), array('class' => 'btn btn-default btn-s-xs')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary btn-s-xs')); ?>
    </footer>

<?php $this->endWidget(); ?>

</div><!-- form -->