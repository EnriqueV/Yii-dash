<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="es" class="app">
<head>
    <meta charset="utf-8"/>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
    <meta name="description"
          content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <base href="<?php echo Yii::app()->getBaseUrl(true); ?>"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/datepicker/datepicker.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icon.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/custom.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/app.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/chosen/chosen.css" type="text/css"/>
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ie/html5shiv.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ie/respond.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ie/excanvas.js"></script>
    <![endif]-->
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<?php
    $isAdmin = isset(Yii::app()->user->isAdmin) ? 1 : 0;
    $isClient = isset(Yii::app()->user->isClient) ? 1 : 0;
?>
<body class="">
<section class="vbox stretch">

<header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
    <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
            <i class="fa fa-bars"></i>
        </a>
        <a href="<?php echo Yii::app()->getBaseUrl(); ?>/index.php?r=site/index" class="navbar-brand">
            <span class="hidden-nav-xs" ><?php echo CHtml::encode(Yii::app()->name); ?></span>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
            <i class="fa fa-cog"></i>
        </a>
    </div>
    <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!--<span class="thumb-sm avatar pull-left">
                          <img src="<?php /*echo Yii::app()->theme->baseUrl; */?>/images/a0.png" alt="...">
                        </span>-->
                <?php echo Yii::app()->user->name ?><b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">
                <li>
                    <?php echo CHtml::link('Salir', array('/site/logout')); ?>
                </li>
            </ul>
        </li>
    </ul>
</header>
<section>
<section class="hbox stretch">
<!-- .aside -->
    <?php
    $piscosXAprobarTotal = "";
    if($isAdmin){
        $piscosXAprobarTotal  = '<b class="badge bg-danger pull-right">'.sizeof(Pisco::model()->findAll(array("condition" => "aprobado =  0"))).'</b>';
    }

    ?>
<aside class="bg-black aside-md hidden-print hidden-xs" id="nav">
    <section class="vbox">
        <section class="w-f scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0"
                 data-size="10px" data-railOpacity="0.2">
                <!-- nav -->

                <nav class="nav-primary hidden-xs">
                    <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm"></div>


                    <?php $this->widget('zii.widgets.CMenu', array(
                        'encodeLabel' => false,
                        'items' => array(
                            array(
                                'label' => '<i class="fa fa-home"></i><span>Home</span>',
                                'url' => array('/site/index'),
                                'linkOptions' => array('class' => 'auto'),
                                'visible'=>!Yii::app()->user->isGuest,
                                'active'=>$this->id=='site'?true:false
                            ),
                            array(
                                'label' => '<i class="fa fa-circle"></i>'.$piscosXAprobarTotal.'<span>Comercios</span>',
                                'url' => array('/pisco'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isAdmin || $isClient,
                                'active'=>$this->id=='pisco'?true:false
                            ),
                            array(
                                'label' => '<i class="fa fa-circle"></i>Notas</span>',
                                'url' => array('/gastronomia'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isClient,
                                'active'=>$this->id=='gastronomia'?true:false
                            ),
                            array(
                                'label' => '<i class="i i-newtab"></i><span>Noticias</span>',
                                'url' => array('#'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isAdmin,
                                'active'=>$this->id=='noticia' OR $this->id=='categoriasNoticia' ?true:false,
                                'items' => array(
                                    array('label' => '<i class="fa fa-minus"></i>Noticias',
                                        'url' => array('/noticia'),
                                        'linkOptions' => array('class' => 'auto')
                                    ),
                                    array('label' => '<i class="fa fa-minus"></i>Categorias',
                                        'url' => array('/categoriasNoticia'), 'linkOptions' => array('class' => 'auto'))
                                )
                            ),
                            array(
                                'label' => '<i class="i i-ellipsis"></i><span>Banners</span>',
                                'url' => array('/banner'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isAdmin,
                                'active'=>$this->id=='banner'?true:false
                            ),array(
                                'label' => '<i class="fa fa-volume-up"></i><span>Radio</span>',
                                'url' => array('/radio'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isAdmin,
                                'active'=>$this->id=='radio'?true:false
                            ),array(
                                'label' => '<i class="fa fa-circle"></i><span>Regiones</span>',
                                'url' => array('/region'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isAdmin,
                                'active'=>$this->id=='radio'?true:false
                            ),
                            array(
                                'label' => '<i class="fa fa-users"></i><span>Administrar usuario</span>',
                                'url' => array('/user/admin'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isAdmin,
                                'active'=>$this->id=='admin'?true:false
                            ),
                            array(
                                'label' => '<i class="fa fa-users"></i><span>Notificaciones</span>',
                                'url' => array('/notificaciones'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isAdmin,
                                'active'=>$this->id=='notificaciones'?true:false
                            ),
                            array(
                                'label' => '<i class="fa fa-circle"></i>Categorias Cupones</span>',
                                'url' => array('/categoriasCupones'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isAdmin,
                                'active'=>$this->id=='categoriasCupones'?true:false
                            ),
                            array(
                                'label' => '<i class="fa fa-circle"></i>Canjear Cupon</span>',
                                'url' => array('/cuponesCodigosGenerados'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isClient,
                                'active'=>$this->id=='cuponesCodigosGenerados'?true:false
                            ),
                            array(
                                'label' => '<i class="i i-settings"></i>Configuración</span>',
                                'url' => array('/configuracion'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isAdmin,
                                'active'=>$this->id=='configuracion' OR $this->id=='miembro'?true:false,
                                'items' => array(
                                    array('label' => '<i class="fa fa-minus"></i>Miembros',
                                        'url' => array('/miembro'),
                                        'linkOptions' => array('class' => 'auto')
                                    ),
                                    array('label' => '<i class="fa fa-minus"></i>Contenidos',
                                        'url' => array('/contenido'),
                                        'linkOptions' => array('class' => 'auto')
                                    )
                                )
                            ),
                            /*array(
                                'label' => '<i class="fa fa-lock"></i><span>Seguridad</span>',
                                'url' => array('#'), 'linkOptions' => array('class' => 'auto',),
                                'visible'=>$isAdmin,
                                'items' => array(
                                    array('label' => '<i class="fa fa-users"></i>Asignaciones',
                                        'url' => array('/rights/assignment/view'), 'linkOptions' => array('class' => 'auto',)
                                    ),
                                    array('label' => '<i class="fa fa-unlock-alt"></i>Permisos',
                                        'url' => array('/rights/authItem/permissions'), 'linkOptions' => array('class' => 'auto',)),
                                    array('label' => '<i class="fa fa-legal"></i>Roles',
                                        'url' => array('/rights/authItem/roles'), 'linkOptions' => array('class' => 'auto',)
                                    ),
                                    array('label' => '<i class="fa fa-tasks"></i>Tareas',
                                        'url' => array('/rights/authItem/tasks'), 'linkOptions' => array('class' => 'auto',)),
                                    array('label' => '<i class="fa fa-exchange"></i>Operaciones',
                                        'url' => array('/rights/authItem/operations'), 'linkOptions' => array('class' => 'auto',))
                                )
                            ),*/
                            array(
                                'label' => '<i class="fa fa-user"></i><span>Registrase</span>',
                                'url' => array('/site/registrarse'),
                                'visible' => Yii::app()->user->isGuest),
                            array(
                                'label' => '<i class="fa fa-sign-in"></i><span>Login</span>',
                                'url' => array('/site/login'),
                                'visible' => Yii::app()->user->isGuest),
                        ),
                        'htmlOptions' => array(
                            'class' => 'nav nav-main',
                            'data-ride' => 'collapse'
                        ),
                        'submenuHtmlOptions' => array('class' => 'nav dk'),
                    ));
                    ?>
                </nav>

                <!-- / nav -->
            </div>
        </section>

        <footer class="footer hidden-xs no-padder text-center-nav-xs">
            <?php echo CHtml::link(
                '<i class="fa fa-power-off"></i>',
                array('/site/logout'),
                array('class' => 'btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs')
            ); ?>
            <a href="#nav" data-toggle="class:nav-xs"
               class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                <i class="fa fa-arrow-circle-o-left text"></i>
                <i class="fa fa-arrow-circle-o-right text-active"></i>
            </a>
        </footer>
    </section>
</aside>
<!-- /.aside -->
<section id="content">
    <section class="hbox stretch">
        <section class="vbox">
            <header class="header bg-white dk">
                <div class="row">
                    <div class="col-sm-5">
                        <?php if (isset($this->breadcrumbs)): ?>
                            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                                'links' => $this->breadcrumbs,
                            )); ?><!-- breadcrumbs -->
                        <?php endif ?>

                    </div>
                    <div class="col-sm-7">
                        <div class="sidebar">

                            <?php
                            $this->beginWidget('zii.widgets.CPortlet', array(
                                'title' => '',
                            ));
                            $this->widget('zii.widgets.CMenu', array(
                                'encodeLabel' => false,
                                'items' => $this->menu,
                                'htmlOptions' => array('class' => 'operations'), 'itemCssClass' => 'btn btn-sm btn-primary custom-button-menu'
                            ));
                            $this->endWidget();
                            ?>
                        </div>
                        <!-- sidebar -->
                    </div>
                </div>
            </header>

            <section class="scrollable wrapper">
                        <!-- alerts-->
                        <?php include 'notice.php' ?>
                        <!-- end alerts-->
                        <?php echo $content; ?>
            </section>

        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open"
       data-target="#nav,html"></a>
</section>
</section>
</section>
</section>
<!-- Bootstrap -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.js"></script>
<!-- datepicker -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/datepicker/bootstrap-datepicker.js"></script>

<!-- App -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/app.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/sortable/jquery.sortable.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/app.plugin.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/chosen/chosen.jquery.min.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            format: 'HH:mm'
        });
        $('.datetimepickerDateAndTime').datetimepicker({
            debug:false,
            format: 'DD/MM/YYYY HH:m'
        });
    });
</script>
</body>
</html>
