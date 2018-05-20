<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Login");
$this->breadcrumbs = array(UserModule::t("Login"),);
?>
<section class="m-b-lg">

<header class="wrapper text-center">
<h2><?php echo UserModule::t("Login"); ?></h2>
</header>
<?php echo CHtml::beginForm(); ?>
<?php if (Yii::app()->user->hasFlash('loginMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>
<?php endif; ?>
<p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

<?php if(CHtml::errorSummary($model)){ ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-ban-circle"></i>
        <?php echo CHtml::errorSummary($model); ?>
    </div>

<?php } ?>


<div class="list-group">
<div class="list-group-item">
<?php //echo CHtml::activeLabelEx($model, 'username'); ?>
<?php echo CHtml::activeTextField($model, 'username',
array(
'placeholder' => UserModule::t('username'),
'class'=>'form-control no-border')) ?>
</div>
    <br>
<div class="list-group-item">
<?php //echo CHtml::activeLabelEx($model, 'password'); ?>
<?php echo CHtml::activePasswordField($model, 'password',
array(
'placeholder' => UserModule::t('password'),
'class'=>'form-control no-border')) ?>
</div>
</div>
<?php echo CHtml::submitButton(UserModule::t("Login"),array('class' => 'btn btn-lg btn-primary btn-block btn-rounded')); ?>
<div class="text-center m-t m-b">
<small><?php //echo CHtml::link(UserModule::t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?></small>
</div>
<!--<div class="text-center m-t m-b">
<small>
<?php //echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
<?php //echo CHtml::activeLabelEx($model, 'rememberMe'); ?>
</small>
</div>-->
<?php
/**
* <div class="row">
<p class="hint">
<?php //echo CHtml::link(UserModule::t("Register"), Yii::app()->getModule('user')->registrationUrl); ?>
| <?php echo CHtml::link(UserModule::t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
</p>
</div>


<div class="row rememberMe">
<?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
<?php echo CHtml::activeLabelEx($model, 'rememberMe'); ?>
</div>

<div class="row submit">

</div>
*/
?>

<?php echo CHtml::endForm(); ?><!-- form -->

<?php
/*
$form = new CForm(array(
'elements' => array(
'username' => array(
'type' => 'text',
'maxlength' => 32,
),
'password' => array(
'type' => 'password',
'maxlength' => 32,
),
'rememberMe' => array(
'type' => 'checkbox',
)
),

'buttons' => array(
'login' => array(
'type' => 'submit',
'label' => 'Login',
),
),
), $model);
*/
?>
</section>