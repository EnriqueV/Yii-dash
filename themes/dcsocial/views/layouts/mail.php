<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="es" class="app">
<head>
<meta charset="utf-8"/>
<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav"/>
<meta name="viewport"    content="width=device-width, initial-scale=1, maximum-scale=1"/>
<base href="<?php echo Yii::app()->getBaseUrl(true); ?>"/>

<title><?php echo CHtml::encode($this->pageTitle); ?></title>


</head>

<body style="font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 13px;color: #788288;line-height: 1.53846;background-color: transparent;">
<section class="vbox">
    <header style="border-radius: 0px;    border: medium none;    margin-bottom: 0px;    padding: 0px;    position: relative;    z-index: 1000;">
        <div class="navbar-header aside-md dk">
            <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
                <i class="fa fa-bars"></i>
            </a>
            <a href="<?php echo Yii::app()->getBaseUrl(); ?>" class="navbar-brand">
                <span class="hidden-nav-xs"><?php echo CHtml::encode(Yii::app()->name); ?></span>
            </a>
            <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
                <i class="fa fa-cog"></i>
            </a>
        </div>
    </header>
    <section>
        <section class="hbox stretch">
            <section id="content">
                <section class="hbox stretch">
                    <section class="vbox">
                        <header style="background-color: #E9EDF4;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <?php if (isset($this->breadcrumbs)): ?>
                                        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                                            'links' => $this->breadcrumbs,
                                        )); ?><!-- breadcrumbs -->
                                    <?php endif ?>
                                </div>
                                <div class="col-sm-6">
                                    <div class="sidebar">
                                        <?php
                                        $this->beginWidget('zii.widgets.CPortlet', array(
                                            'title' => '',
                                        ));
                                        $this->widget('zii.widgets.CMenu', array(
                                            'items' => $this->menu,
                                            'htmlOptions' => array('class' => 'nav operations'),
                                        ));
                                        $this->endWidget();
                                        ?>
                                    </div>
                                    <!-- sidebar -->
                                </div>
                            </div>
                        </header>
                        <section class="scrollable wrapper">
                            <section class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <!-- alerts-->
                                        <?php include 'notice.php' ?>
                                        <!-- end alerts-->
                                        <?php echo $content; ?>
                                    </div>
                                </div>
                            </section>
                        </section>
                    </section>
                </section>
                <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open"
                   data-target="#nav,html"></a>
            </section>
        </section>
    </section>
</section>
</body>
</html>
