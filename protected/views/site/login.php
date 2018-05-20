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
    <h3 class="m-b-none">Login</h3>
</div>
<p>Complete el siguiente formulario con sus credenciales de inicio de sesión:</p>

<div class="row">
    <div class="col-sm-3">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

        <?php echo Yii::t('models', 'required.legend'); ?>

<!--	<div class="row">
		<?php /*echo $form->labelEx($model,'username'); */?>
		<?php /*echo $form->textField($model,'username'); */?>
		<?php /*echo $form->error($model,'username'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'password'); */?>
		<?php /*echo $form->passwordField($model,'password'); */?>
		<?php /*echo $form->error($model,'password'); */?>
		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
	</div>

	<div class="row rememberMe">
		<?php /*echo $form->checkBox($model,'rememberMe'); */?>
		<?php /*echo $form->label($model,'rememberMe'); */?>
		<?php /*echo $form->error($model,'rememberMe'); */?>
	</div>

	<div class="row buttons">
		<?php /*echo CHtml::submitButton('Login'); */?>
	</div>-->
        <section class="panel panel-default" style="background-color: transparent;">
            <div class="panel-body">
                <form role="form">
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'username'); ?>
                        <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'username'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'password'); ?>
                        <?php echo $form->passwordField($model,'password', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model,'password'); ?>
                    </div>
                    <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-s-md btn-primary btn-rounded')); ?>
                </form>
            </div>
        </section>

<?php $this->endWidget(); ?>
</div><!-- form -->
    </div>