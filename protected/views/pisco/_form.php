<?php
/* @var $this PiscoController */
/* @var $model Pisco */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pisco-form',
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

    <?php
    if (Yii::app()->myClass->isAdmin()) {
        ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'userId'); ?><br>
            <select style="width:500px" class="chosen-select form-control" name="Pisco[userId]">
                <option value="">Seleccinar..</option>
                <?php foreach (User::model()->findAll(array("condition"=>"superuser =  2")) as $user) { ?>
                    <option value="<?php echo $user->id; ?>" <?php if ($model->userId == $user->id) { echo "selected";
                    } ?>><?php echo Yii::app()->myClass->getNamesFromUser($user); ?></option>
                <?php } ?>
            </select>
            <?php echo $form->error($model, 'userId'); ?>
        </div>
    <?php
    } else { //useriologeado
        echo $form->hiddenField($model, 'userId', array('type' => "hidden", 'size' => 2, 'maxlength' => 2));
    } ?>


    <div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>150, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'latitud'); ?>
		<?php echo $form->textField($model,'latitud',array('size'=>10,'maxlength'=>10, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'latitud'); ?>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'longitud'); ?>
		<?php echo $form->textField($model,'longitud',array('size'=>10,'maxlength'=>10, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'longitud'); ?>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>60,'maxlength'=>75, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textArea($model,'direccion',array('rows'=>6, 'cols'=>50, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'web'); ?>
		<?php echo $form->textField($model,'web',array('size'=>60,'maxlength'=>150, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'web'); ?>
	</div>

<!--    <div class="form-group">
		<?php /*echo $form->labelEx($model,'userId'); */?>
		<?php /*echo $form->textField($model,'userId'); */?>
		<?php /*echo $form->error($model,'userId'); */?>
	</div>-->
    <!-- TODO: Si es administrado mostrar en un dropdown los usuario de tipo cliente-->

    <div class="form-group">
		<?php echo $form->labelEx($model,'youtubeUrl'); ?>
		<?php echo $form->textField($model,'youtubeUrl',array('size'=>45,'maxlength'=>45, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'youtubeUrl'); ?>
	</div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'regionId'); ?>
        <?php echo $form->dropDownList($model,'regionId',CHtml::listData(Region::model()->findAll(),'id','nombre'),array('empty'=>'--Seleccione un item--','class' => 'form-control')); ?>
        <?php echo $form->error($model,'regionId'); ?>
    </div>

    <?php
    if (Yii::app()->myClass->isAdmin()) {
    ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'esDestacado'); ?>
            <?php echo $form->checkBox($model, 'esDestacado', array('class' => 'span5', 'maxlength' => 45)); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'activo'); ?>
            <?php echo $form->checkBox($model, 'activo', array('class' => 'span5', 'maxlength' => 45)); ?>
        </div>

        <?php
        if (!$model->aprobado) { //Nada mas mostrardo cuando Aprobado sea cero
            ?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'aprobado'); ?>
                <?php echo $form->checkBox($model, 'aprobado', array('class' => 'span5', 'maxlength' => 45)); ?>
            </div>
        <?php
        }
        ?>
    <?php
        }
    ?>
    <footer class="panel-footer bg-light lter">
        <?php echo CHtml::link('Cancelar',array('pisco/'), array('class' => 'btn btn-default btn-s-xs')); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class' => 'btn btn-primary btn-s-xs')); ?>
	</footer>

<?php $this->endWidget(); ?>

</div><!-- form -->