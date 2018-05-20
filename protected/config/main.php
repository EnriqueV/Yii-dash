<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'theme' => 'dcsocial',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Directorio',
    'language' => 'es',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
		'application.modules.rights.*',
        'application.modules.rights.components.*',
        'ext.nineinchnick.edatatables.*',
        'ext.ECompositeUniqueValidator',
        'ext.CAdvancedArBehavior',
        'ext.web-user-behavior.WebUserBehavior'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'piscos',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1',$_SERVER['REMOTE_ADDR'],'::1'),
		),
        'user' => array(
            'tableUsers' => 'user',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
        ),
		 'rights' => array(
             # Name of the role with super user privileges.
             'superuserName'=>'Admin',

             # Name of the authenticated user role.
             'authenticatedName'=>'Authenticated',

             # Name of the user id column in the database.
             'userIdColumn'=>'id',

             # Name of the user name column in the database.
             'userNameColumn'=>'username',

             # Whether to enable authorization item business rules.
             'enableBizRule'=>false,

             # Whether to enable data for business rules.
             'enableBizRuleData'=>false,

             # Whether to use item description instead of name.
             'displayDescription'=>false,

             # Key to use for setting success flash messages.
             'flashSuccessKey'=>'RightsSuccess',

             # Key to use for setting error flash messages.
             'flashErrorKey'=>'RightsError',

            # Whether to enable installer.
            'install'=>false,
            'debug'=>false,
        ),
	),

	// application components
	'components'=>array(
        'myClass' => array(
            'class' => 'ext.MyClass',
        ),
        /*'coupon' => array(
            'class' => 'ext.coupon',
        ),*/
        'user' => array(
            'class' => 'RWebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
            'behaviors' => array(
                'ext.web-user-behavior.WebUserBehavior'
            ),
        ),
		'authManager' => array(
            'class' => 'RDbAuthManager',
            'connectionID' => 'db',
            'defaultRoles' => array('Authenticated', 'Guest'),
        ),

		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
                // REST patterns
                array('api/login', 'pattern'=>'api/<model:\w+>/<action:\w+>', 'verb'=>'POST'),
                array('api/registrarse', 'pattern'=>'api/<model:\w+>/<action:\w+>', 'verb'=>'POST'),
                array('api/cambiarPassword', 'pattern'=>'api/<model:\w+>/<action:\w+>', 'verb'=>'POST'),
                array('api/recuperarClave', 'pattern'=>'<controller>/recuperarClave/<correo>', 'verb'=>'GET'),
                array('api/guardar_codigo_cupon', 'pattern'=>'api/<model:\w+>/<action:\w+>', 'verb'=>'POST'),
                array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
                array('api/noticiaDetalle', 'pattern'=>'<controller>/noticiaDetalle/<id:\d+>', 'verb'=>'GET'),
                array('api/piscoDetalle', 'pattern'=>'<controller>/piscoDetalle/<id:\d+>', 'verb'=>'GET'),
                array('api/cuponDetalle', 'pattern'=>'<controller>/cuponDetalle/<id:\d+>/<userId:\d+>', 'verb'=>'GET'),
                array('api/miembroDetalle', 'pattern'=>'<controller>/miembroDetalle/<id:\d+>', 'verb'=>'GET'),
                array('api/regionDetalle', 'pattern'=>'<controller>/miembroDetalle/<id:\d+>', 'verb'=>'GET'),
                // Other controllers
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),


		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'trace, info, error, warning, vardump',
                ),
                // uncomment the following to show log messages on web pages
                array(
                    'class' => 'CWebLogRoute',
                    'enabled' => YII_DEBUG,
                    'levels' => 'error, warning, trace, notice',
                    'categories' => 'application',
                    'showInFireBug' => false,
                ),
            ),
        ),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
        'mail'=>array( //TODO, definir el tamaño de la imagen de piscos.
            'adminEmail'=>'piscomagic@outlook.com',
            'username'=>'developer4130@gmail.com',
            'password'=>'developer4130@',
        ),
        'maxFotosxSlide' => 3, //Maximo fotos por perfil.
        'fotoPiscoDimensions'=>array( //TODO, definir el tamaño de la imagen de piscos.
            'width'=>400,
            'height'=>300
        ),
        'fotoCuponDescuentoDimensions'=>array( //TODO, definir el tamaño de la imagen de cupones de descuento.
            'width'=>400,
            'height'=>300
        ),
        'fotoBannerDimensions'=>array( //TODO, definir el tamaño de la imagen del banner.
            'width'=>400,
            'height'=>300
        ),
        'fotoNoticiaDimensions'=>array( //TODO, definir el tamaño de la imagen del banner.
            'width'=>400,
            'height'=>300
        ),
        'fotoGastronomiaDimensions'=>array( //TODO, definir el tamaño de la imagen.
            'width'=>400,
            'height'=>300
        ),
        'rol_admin'=>'Admin',
        'rol_cliente'=>'Cliente',
        'rol_usuario'=>'Usuario',
        'rol_usuario_id'=> 3,
	),
);
