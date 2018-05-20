<!DOCTYPE html>
<html lang="es" class="app">
<head>
    <meta charset="utf-8" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icon.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/custom.css" type="text/css" />
    <!--[if lt IE 9]>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ie/html5shiv.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ie/respond.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ie/excanvas.js"></script>
    <![endif]-->
</head>
<body class="">
    <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
        <div class="container aside-xl">
            <?php echo $content; ?>
        </div>
    </section>

    <?php
    /**
    <!-- footer - - >
    <footer id="footer">
    <div class="text-center padder">
    <p>
    <small>Web app framework base on Bootstrap<br>&copy; 2013</small>
    </p>
    </div>
    </footer>
    <!-- / footer -->
     */
    ?>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.js"></script>
    <!-- App -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/app.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/app.plugin.js"></script>
</body>
</html>