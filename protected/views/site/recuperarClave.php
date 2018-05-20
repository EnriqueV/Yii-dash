<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="m-b-md">
    <h3 class="m-b-none">Recuperar clave</h3>
</div>
<p>Complete el siguiente formulario con su nueva clave para el acceso a la App:</p>

<div class="row">
    <div class="col-sm-12">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
        <section class="" style="background-color: transparent;">
            <div class="panel-body">
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
                if ($procesoExitoso) {
                    ?>
                    <div class='alert alert-success'>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-ban-circle"></i>
                        Contraseña recuperada con exito!</div>
                <?php } ?>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'repassword'); ?>
                    <?php echo $form->passwordField($model, 'repassword', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'repassword'); ?>
                </div>
                <?php echo CHtml::submitButton('Nueva Clave', array('class' => 'btn btn-s-md btn-primary btn-rounded')); ?>
            </div>
        </section>

<?php $this->endWidget(); ?>
</div><!-- form -->
    </div>
