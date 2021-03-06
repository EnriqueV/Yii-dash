<?php
/**
 * Created by PhpStorm.
 * User: PERSONAL
 * Date: 19/10/17
 * Time: 20:45
 */
/* @var $model CuponesDescuento */
$this->menu=array(
    array('label'=>'Piscos', 'url'=>array('index')),
);
?>
<div class="panel-group" id="accordion">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'foto-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data',"roles"=>"form")
)); ?>
<section class="panel panel-default">
    <header class="panel-heading font-bold" style="background-color: #E02217;">
        <a data-toggle="collapse" data-target="#collapseOne" style="display: block; cursor: pointer;color: #fff !important">
            Crear cupon de descuento
        </a>
    </header>
    <div id="collapseOne" class="panel-collapse collapse <?php if($form->errorSummary($model)){ echo "in"; }?>">
    <div class="panel-body">
        <?php if($form->errorSummary($model)){ ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <i class="fa fa-ban-circle"></i><strong>Oh snap!</strong>
                <?php echo $form->errorSummary($model); ?>
            </div>
        <?php } ?>
            <div class="form-group">
                <?php echo $form->labelEx($model,'name'); ?>
                <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'maxlength' => 75)); ?>
                <?php echo $form->error($model,'name'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'categoriaId'); ?>
                <?php //echo $form->textField($model,'categoriaId',array('class' => 'form-control')); ?>
                <?php echo $form->dropDownList($model,'categoriaId',CHtml::listData(CategoriasCupones::model()->findAll(),'id','nombre'),array('empty'=>'--Seleccione una categoria--','class' => 'form-control'),array('class' => 'form-control')); ?>
                <?php echo $form->error($model,'categoriaId'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'descripcion'); ?>
                <?php echo $form->textArea($model, 'descripcion', array('class' => 'form-control', 'maxlength' => 300)); ?>
                <?php echo $form->error($model,'descripcion'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'imageUrl'); ?>
                <?php echo $form->fileField($model, 'imageUrl', array('class' => 'form-control', 'maxlength' => 75)); ?>
                <?php echo $form->error($model,'imageUrl'); ?>
            </div>
        <div class="form-group">
                <?php echo $form->labelEx($model,'expirationDate'); ?>
                <div class='input-group date' id='datetimepicker3'>
                    <?php echo $form->textField($model,'expirationDate',array('size'=>45,'maxlength'=>45,"class"=>"form-control datetimepickerDateAndTime")); ?>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <?php echo $form->error($model,'expirationDate'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Cupon</button>

    </div>
        </div>
</section>
    <?php $this->endWidget(); ?>
    </div>
<h3>Cupones</h3>
<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>

