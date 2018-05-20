<?php
$this->pageTitle=Yii::app()->name . ' ddd- '.UserModule::t("Login");
$this->breadcrumbs=array(
    UserModule::t("Login"),
);
?>

    <a class="navbar-brand block" href="<?php echo Yii::app()->getBaseUrl(); ?>"><?php echo UserModule::t("Login"); ?></a>
    <section class="m-b-lg">
        <header class="wrapper text-center">
            <strong>Sign in to get in touch</strong>
        </header>
        <form action="index.html">
            <div class="list-group">
                <div class="list-group-item">
                    <input type="email" placeholder="Email" class="form-control no-border">
                </div>
                <div class="list-group-item">
                    <input type="password" placeholder="Password" class="form-control no-border">
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
            <div class="text-center m-t m-b"><a href="#"><small>Forgot password?</small></a></div>
            <div class="line line-dashed"></div>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a href="signup.html" class="btn btn-lg btn-default btn-block">Create an account</a>
        </form>
    </section>

    <h1><?php echo UserModule::t("Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

    <div class="success">
        <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
    </div>

<?php endif; ?>

    <p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

    <div class="form">
        <?php echo CHtml::beginForm(); ?>

        <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

        <?php echo CHtml::errorSummary($model); ?>

        <div class="row">
            <?php echo CHtml::activeLabelEx($model,'username'); ?>
            <?php echo CHtml::activeTextField($model,'username') ?>
        </div>

        <div class="row">
            <?php echo CHtml::activeLabelEx($model,'password'); ?>
            <?php echo CHtml::activePasswordField($model,'password') ?>
        </div>

        <div class="row">
            <p class="hint">
                <?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
            </p>
        </div>

        <div class="row rememberMe">
            <?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
            <?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
        </div>

        <div class="row submit">
            <?php echo CHtml::submitButton(UserModule::t("Login")); ?>
        </div>

        <?php echo CHtml::endForm(); ?>
    </div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>