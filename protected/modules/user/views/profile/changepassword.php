<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change password");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Change password"),
);
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);
?>

<h1><?php echo UserModule::t("Change password"); ?></h1>
<div class="row">
    <div class="col-sm-3">
<div class="panel-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo $form->errorSummary($model); ?>

    <div class="form-group">
	<?php echo $form->labelEx($model,'oldPassword'); ?>
	<?php echo $form->passwordField($model,'oldPassword',array('class' => 'form-control')); ?>
	<?php echo $form->error($model,'oldPassword'); ?>
	</div>

    <div class="form-group">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password',array('class' => 'form-control')); ?>
	<?php echo $form->error($model,'password'); ?>
	</div>
    <p class="hint">
        <?php echo UserModule::t("Minimal password length 4 symbols."); ?>
    </p>

    <div class="form-group">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword',array('class' => 'form-control')); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>


    <footer class="panel-footer bg-light lter">
	<?php echo CHtml::submitButton(UserModule::t("Save"),array('class' => 'btn btn-primary btn-s-xs')); ?>
	</footer>

<?php $this->endWidget(); ?>
</div><!-- form -->
        </div></div>