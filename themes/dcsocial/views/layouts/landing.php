<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="KeyDesign" />
    <meta name="description" content="Pisco Magic" />
    <meta name="keywords" content="Pisco Magic" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- SITE TITLE -->
    <title>Pisco Magic</title>

    <!-- FAVICON -->
    <link rel="icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/favicon.ico">

    <!-- WEB FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:100,300,400,600,700' rel='stylesheet' type='text/css'>

    <!-- STYLESHEETS -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/landing/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/landing/fonts/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/landing/css/responsive.css" />
    <!-- JQUERY -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
<div style="background: #fee000;
/*width: 100%;*/
color: #000000;
font-weight: bold;
font-size: 16px;
text-align: center;
text-transform: uppercase;" class="mantenimiento">
Sitio web y aplicación en construcción
</div>

<!-- PRELOADER -->
<div id="preloader"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/logo.png" alt=""></div>

<!-- MAIN NAV -->
<a id="main-nav" href="#sidr"><span class="flaticon-menu9"></span></a>
<div id="sidr" class="sidr">

    <!-- MAIN NAV LOGO -->
    <a href="#" id="menu-logo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/menu-logo.png" alt=""></a>

    <!-- MAIN NAV LINKS -->
    <ul>
        <li><a href="#Home" ><span class="icons flaticon-house3"></span>Inicio</a>
        </li>
        <li><a href="#Features" ><span class="icons flaticon-drawer1"></span>Características</a>
        </li>
        <li><a href="#About" ><span class="icons flaticon-cursor7"></span>Historia de piscos</a>
        </li>
        <li><a href="#Download" ><span class="icons flaticon-download11"></span>Descarga</a>
        </li>
        <li><a href="#Contact" ><span class="icons flaticon-small72"></span>Contáctenos</a>
        </li>
        <li><a href="#Register" ><span class="icons flaticon-plus7"></span>Regístrate</a>
        </li>
        <li><?php echo CHtml::link('<span class="icons flaticon-profile"></span>Login',array('user/login')); ?>
        </li>
    </ul>
    <!-- END MAIN NAV LINKS -->
</div>
<!-- END MAIN NAV -->

<!-- PAGE LOGO -->
<div class="wrap">
    <div id="logo">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/logo.png" alt=""> </a>
    </div>
</div>
<!-- END PAGE LOGO -->

<!-- LANDING PAGE CONTENT -->
<div id="fullpage">

<!-- RIGHT HAND & PHONE MOCK-UP IMAGES -->
<div class="wrap">
    <div class="section-image">
        <!-- Home IMAGE --><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/1.jpg" alt="">
        <!-- Features IMAGE --><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/1.jpg" alt="">
        <!-- About IMAGE --><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/1.jpg" alt="">
        <!-- Video IMAGE --><!--<img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/4.jpg" alt="">-->
        <!-- Clients IMAGE --><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/1.jpg" alt="">
        <!-- Screenshots IMAGE --><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/1.jpg" alt="">
        <!-- Pricing IMAGE --><!--<img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/3.jpg" alt="">-->
        <!-- Download IMAGE --><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/1.jpg" alt="">
        <!-- Contact IMAGE --><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/1.jpg" alt="">
        <!-- Contact IMAGE --><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/1.jpg" alt="">
    </div>
    <div id="hand"></div>
</div>
<!-- END RIGHT HAND & PHONE MOCK-UP -->


<!-- SECTION HOME -->
<div class="section " id="section0">
    <div class="wrap">
        <div class="box">
            <!-- SECTION HOME CONTENT -->
            <h1><strong>Bienvenido</strong> a <strong>Pisco</strong> Magic</h1>
            <p>Pisco Magic es una aplicación innovadora con esencia peruana que promueve el encuentro de nuestro Pisco y la Gastronomía<br>
                Peruana con el mundo entero. Pisco es Perú.<br>
                <br>Muy pronto disponible en el App Store y Google Play.</p>
            <a href="#Download" class="simple-button"><span class="icon flaticon-download7"></span>Descarga la App</a>
        </div>
        <!-- END SECTION HOME CONTENT -->
    </div>
</div>
<!-- END SECTION HOME -->

<!-- SECTION FEATURES -->
<div class="section " id="section1">
    <div class="wrap">
        <div class="box">
            <!-- SECTION FEATURES CONTENT -->
            <h2><strong>Principales</strong> Caracteristicas</h2>
            <p>Pisco Magic, es una aplicación completamente gratis y fácil de navegar. Te mantiene informado sobre temas del Pisco, Gastronomía y te conecta a tu música favorita del Perú y de otros países.</p>
            <ul class="features">
                <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> ¿Qué es el Pisco? <span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-small62"></span>Lorem ipsum dolor sit amet, consectetur adipisicing elitr eiciendis autem aperiam.</span></span></span></a> </li>
                <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Regiones Pisqueras<span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-small62"></span>Lorem ipsum dolor sit amet, consectetur adipisicing elitr eiciendis autem aperiam.</span></span></span></a> </li>
                <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Directorio de Pisco<span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-small62"></span>Lorem ipsum dolor sit amet, consectetur adipisicing elitr eiciendis autem aperiam.</span></span></span></a> </li>
                <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Noticias y eventos<span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-small62"></span>Lorem ipsum dolor sit amet, consectetur adipisicing elitr eiciendis autem aperiam.</span></span></span></a> </li>
            </ul>
            <ul class="features">
                <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Cócteles y sus platos preferidos.<span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-small62"></span>Lorem ipsum dolor sit amet, consectetur adipisicing elitr eiciendis autem aperiam.</span></span></span></a> </li>
                <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Radio y música<span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-small62"></span>Lorem ipsum dolor sit amet, consectetur adipisicing elitr eiciendis autem aperiam.</span></span></span></a> </li>
                <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Cupones de descuento <span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-small62"></span>Lorem ipsum dolor sit amet, consectetur adipisicing elitr eiciendis autem aperiam.</span></span></span></a> </li>
                <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Mucho mas completamente gratis! <span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-small62"></span>Lorem ipsum dolor sit amet, consectetur adipisicing elitr eiciendis autem aperiam.</span></span></span></a> </li>
            </ul>
            <!-- END SECTION FEATURES CONTENT -->
        </div>
    </div>
</div>
<!-- END SECTION FEATURES -->

<!-- SECTION ABOUT -->
<div class="section" id="section2">
    <div class="wrap">
        <div class="box">
            <!-- SECTION ABOUT CONTENT -->
            <h2>Acerca de <strong>Pisco</strong> Magic</h2>
            <div class="tabs tabs-style-linemove">
                <!-- TABS LINKS -->
                <nav>
                    <ul>
                        <li class="tab-current"><a href="#section-linemove-1"><span class="icon flaticon-lightbulb"></span><span> Historia</span></a>
                        </li>
                        <li><a href="#section-linemove-2"><span class="icon flaticon-adjust3"></span><span> Miembros</span></a>
                        </li>
                        <li><a href="#section-linemove-3"><span class="icon flaticon-drawer1"></span><span> Video</span></a>
                        </li>
                        <li><a href="#section-linemove-4"><span class="icon flaticon-laptop3"></span><span> Secciones</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- END TABS LINKS -->

                <!-- TABS CONTENT -->
                <div class="content-wrap">

                    <!-- TAB 1 -->
                    <section id="section-linemove-1">
                        <?php $historia = Contenido::model()->findByAttributes(array('tipo'=>'historia'));  ?>
                        <h4><span class="icon flaticon-lightbulb"></span> <?php echo $historia->titulo; ?></h4>
                        <p><?php echo $historia->texto; ?></p>
                    </section>

                    <!-- TAB 2 -->
                    <section id="section-linemove-2">
                        <h4></h4>
                        <?php
                        foreach(Miembro::model()->findAll(array('order'=>'posicion')) as $miembro){  ?>
                            <ul class="features">
                                <li><a class="tooltip" href="#"><img src="<?php echo Yii::app()->baseUrl . "/images/miembros/" . $miembro->imageUrl; ?>" height="130" width="120"/></a></li>
                                <li><a class="tooltip" href="#"><?php echo $miembro->nombre; ?></a> </li>
                            </ul>
                            <?php } ?>
                       <!-- <ul class="features">
                            <li><a class="tooltip" href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/miembros/LUCERO_VILLAGARCIA.jpg" height="130" width="120"/></a></li>
                            <li><a class="tooltip" href="#"> Lucero Villagarcia <br> </a> </li>
                        </ul>
                        <ul class="features">
                            <li><a class="tooltip" href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/miembros/HANS_HILBURG.jpg" height="130" width="120"/></a></li>
                            <li><a class="tooltip" href="#"> Hans Hillburg</a> </li>
                        </ul>
                        <ul class="features">
                            <li><a class="tooltip" href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/miembros/RICARDO_VILLANUEVA.jpg" height="130" width="120"/></a></li>
                            <li><a class="tooltip" href="#"> Ricardo Villanueva <br> </a> </li>
                        </ul>
                        <ul class="features">
                            <li><a class="tooltip" href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/miembros/JUAN_YUKI_NAKANDAKARI.jpg" height="130" width="120"/></a></li>
                            <li><a class="tooltip" href="#"> Juan Yuki <br> Nakandakari</a> </li>
                        </ul>
                        <ul class="features">
                            <li><a class="tooltip" href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/images/miembros/ELIZABETH_CHANGANAQUI.jpg" height="130" width="120"/></a></li>
                            <li><a class="tooltip" href="#"> Elizabeth <br>Changanaqui</a> </li>
                        </ul>-->

                        <!--<ul class="features">
                            <li><a class="tooltip" href="#"><span class="icon flaticon-outlined3"></span> Multiple Demos</a> </li>
                            <li><a class="tooltip" href="#"><span class="icon flaticon-lightbulb"></span> Amazing Features</a> </li>
                        </ul> -->
                    </section>

                    <!-- TAB 3 -->
                    <section id="section-linemove-3">
                        <iframe width="300" height="200" src="https://www.youtube.com/embed/V6EoQM6tKtQ" frameborder="0" allowfullscreen></iframe>
                    </section>

                    <!-- TAB 4 -->
                    <section id="section-linemove-4">
                        <p>
                        <ul class="features">
                            <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Directorio de Piscos</a> </li>
                            <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Gastronimia</a> </li>
                            <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Radio</a> </li>
                        </ul>
                        <ul class="features">
                            <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Eventos</a> </li>
                            <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Cupones</a> </li>
                            <li><a class="tooltip" href="#"><span class="icon flaticon-small62"></span> Mucho mas</a> </li>
                        </ul>
                        </p>
                    </section>
                </div>
                <!-- END TABS CONTENT -->

                <!-- END SECTION ABOUT -->
            </div>
        </div>
    </div>
</div>
<!-- END SECTION ABOUT -->

<!-- SECTION DOWNLOAD -->
<div class="section" id="section3" data-anchor="Download">
    <div class="wrap">
        <div class="box">
            <!-- SECTION DOWNLOAD CONTENT-->
            <h2><strong>Descarga</strong> nuestra aplicación</h2>
            <p>Vive la experiencia y compartamos con el mundo entero que Pisco es Perú!<br>
                Muy pronto disponible en el App Store y Google Play.</p>

            <!-- DOWNLOAD APPSTORE-->
            <a href="#" class="simple-button appstore-button"><span class="icon appstore"></span>App Store</a>
            <!-- DOWNLOAD PLAYSTORE-->
            <a href="#" class="simple-button playstore-button"><span class="icon playstore"></span>Google Play</a>

            <!-- END SECTION DOWNLOAD -->
        </div>
    </div>
</div>
<!-- END SECTION DOWNLOAD -->


<!-- SECTION CONTACT -->
<div class="section" id="section4">
    <div class="wrap">
        <div class="box">
            <!-- SECTION CONTACT CONTENT-->
            <h2><strong>Contáctenos</strong></h2>
            <ul class="features">
                <li>
                    <a class="tooltip" href="#"><span class="icon flaticon-telephone1"></span> Llámenos<span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-telephone1"></span>Tel: 922-236 470 <br>Whatsap: +51922-236470 </span></span></span></a> </li>
                <li><span class="tooltip"><span class="icon flaticon-map5"></span>Nuestra ubicación<span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-map5"></span>Calle Hercules 121 San Roque, Surco Lima, Perú
                            <br><a href="https://goo.gl/maps/bkuJmXvgxqN2" target="_blank">Ver mapa</a>
                            </span>
                            </span>
                            </span>
                        </span>
                </li>
            </ul>
            <ul class="features">
                <li><span class="tooltip"><span class="icon flaticon-cursor7"></span>Sitio Oficial <span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-cursor7"></span>
                            <br> <a href="#" target="_blank">www.piscomagic.com</a>
                            </span>
                            </span>
                            </span>
                            </span>
                </li>
                <li><span class="tooltip"><span class="icon flaticon-mail9"></span> Enviar Email<span class="tooltip-content"><span class="tooltip-text"><span class="tooltip-inner"><span class="icon flaticon-mail9"></span>
                            <br> <a href="mailto:info@piscomagic.com" target="_blank">info@piscomagic.com</a>
                            </span>
                            </span>
                            </span>
                            </span>
                </li>
            </ul>

            <!-- SECTION CONTACT FORM-->
            <form role="form" method="post" id="contact-form" name='ContactForm'>
                <input type="text" placeholder="Nombre" name="ContactForm[name]" id="Name" required>
                <input type="email" placeholder="Email" name="ContactForm[email]" id="Email" required>
                <input type="text" placeholder="Telefono" name="ContactForm[phone]" id="Phone">
                <input type="text" placeholder="Asunto" name="ContactForm[subject]" id="Subject">
                <textarea placeholder="Mensaje" name="ContactForm[body]" id="Message" required></textarea>
                <button type="submit" name='submit' id="submit">Enviar</button>
                <div id="success"></div>
            </form>
            <!-- END SECTION CONTACT -->
        </div>
    </div>
</div>

<!-- SECTION CONTACT -->
<?php echo $content; ?>
<!-- SECTION CONTACT -->

</div>
<!-- SOCIAL ICONS -->
<div class="wrap">
    <div id="social-icons">
        <ul>
            <li><a href=""><i class="flaticon-facebook6"></i></a> </li>
            <li><a href=""><i class="flaticon-social19"></i></a> </li>
            <li><a href=""><i class="flaticon-google16"></i></a> </li>
            <li><a href=""><i class="flaticon-youtube4"></i></a> </li>
            <!--                <li><a href=""><i class="flaticon-social7"></i></a> </li>
--><!--                <li><a href=""><i class="flaticon-logo3"></i></a> </li>
-->            </ul>
    </div>
</div>
<!-- END SOCIAL ICONS -->


<!-- SCRIPTS -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/js/jquery.easings.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/js/jquery.fullPage.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/js/cbpFWTabs.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/js/jquery.sidr.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/js/scripts.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.js"></script>
<!--<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/landing/js/video.js"></script> -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-60776023-1', 'auto');
    ga('send', 'pageview');

</script>
</body>

</html>
