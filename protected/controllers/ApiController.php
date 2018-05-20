<?php
/**
 * Created by PhpStorm.
 * User: PERSONAL
 * Date: 21/10/17
 * Time: 21:59
 */
class ApiController extends Controller
{

    protected function beforeAction($action)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        return parent::beforeAction($action);
    }

    public function actionLogin()
    {


        $json = file_get_contents('php://input');
        $post_vars = CJSON::decode($json, true); //true means use associative array
        $model = new User;
        $model->setScenario('LoginApp');
        $model->attributes = $post_vars;
        if ($model->validate()) {
            $model->superuser = 3; //de tipo Usuario
            $model->password = UserModule::encrypting($model->password);
            $userExist = User::model()->findByAttributes($model->getAttributes(array("username", "password","superuser")));
            if($userExist){
                echo CJSON::encode($this->getOtherDataUser($userExist));
            }else{
                $this->_sendResponse(404,
                    CJSON::encode(
                        array(
                            'error' => "Usuario No encontrado",
                        )
                    )
                );
            }
        } else {
            $this->_sendResponse(500,
                CJSON::encode(
                    array(
                        'error' => $this->getErrrorStrFromModel($model),
                    )
                )
            );
        }
    }

    public function actionrecuperarClave($correo)
    {
        /** Los codigos solo son validos unicamente para el actual dia */
        //echo $correo;
        //echo Yii::app()->myClass->sendEmail("albert.hugo@hotmail.com","lhugo.calderon@gmail.com","Hugo","Subject","Mensaje Texto");
        $user = User::model()->findByAttributes(array("email" => $correo));
        //echo 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
        if ($user) {
            //Eliminar codigos expirados al usuario
            $ahora = date("Y-m-d");
            /* @var $codigo CodigoRecuperarClave */
            $codigos = CodigoRecuperarClave::model()->findAllByAttributes(array("userId" => $user->id));
            foreach ($codigos as $codigo) {
                //if($codigo->expiracion != $ahora){
                    $codigo->delete();
                //}
            }
            //</Eliminar codigos expirados
            Yii::import('ext.coupon', false);
            $options = array("mask" => "XXXX");
            $coupons = coupon::generate_coupons(1, $options);
            $codigoGenerado = "";
            foreach ($coupons as $key => $value) {
                $codigoGenerado = md5($value);
            }
            $codigo = new CodigoRecuperarClave;
            $codigo->codigo = $codigoGenerado;
            $codigo->userId = $user->id;
            $codigo->expiracion = $ahora;
            if ($codigo->save()) {
                $url = 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'].'/site/recuperarClave?codigo='.$codigoGenerado;
                $sendTo = "albert.hugo@hotmail.com";
                $fromEmail = "lhugo.calderon@gmail.com";
                $fromName = "lhugo.calderon@gmail.com";
                //$mensajebody = "Su codigo de recuperacion es <a href ='".$url."'>Click para abrir el enlace</a>";
                //$exito = Yii::app()->myClass->sendEmail($sendTo, $fromEmail, "Hugo", "Recuperar Clave", $mensajebody);
                $exito = Yii::app()->myClass->sendCodeRecoveryAccountMessage($sendTo, $fromName, "Recuperar cuenta de Piscos Magic",$url);
                if($exito){
                    $codigoError = 200;
                    $mensaje = "Se ha enviado un mensaje a su correo electronico para recuperar su cuenta";
                    $key = "success";
                }else{
                    $codigoError = 500;
                    $mensaje = "Ocurrio un error al enviar el mensaje a su correo, intente mas tarde.";
                    $key = "error";
                }
                $this->_sendResponse($codigoError,
                    CJSON::encode(
                        array(
                            $key => $mensaje,
                        )
                    )
                );
            } else {
                $this->_sendResponse(500,
                    CJSON::encode(
                        array(
                            'error' => $this->getErrrorStrFromModel($codigo),
                        )
                    )
                );
            }
        } else {
            $this->_sendResponse(404,
                CJSON::encode(
                    array(
                        'error' => "No existe algun usuario con el correo digitado.",
                    )
                )
            );
        }
    }

    public function actionNoticiaDetalle($id)
    {
        $model = Noticia::model()->findByPk($id);
        if ($model) {
            $this->_sendResponse(200, CJSON::encode($model));
        } else {

            $this->_sendResponse(404,
                CJSON::encode(
                    array(
                        'error' => "Noticia no encontrada",
                    )
                )
            );
        }
    }

    public function actionRegionDetalle($id)
    {
        $model = Region::model()->findByPk($id);
        if ($model) {
            $this->_sendResponse(200, CJSON::encode($model));
        } else {

            $this->_sendResponse(404,
                CJSON::encode(
                    array(
                        'error' => "Region no encontrada",
                    )
                )
            );
        }
    }

    public function actionPiscoDetalle($id)
    {
        $model = Pisco::model()->findByPk($id);
        if ($model) {
            $model = $this->getOtherDataPisco($model,null);
            $this->_sendResponse(200, CJSON::encode($model));
        } else {
            $this->_sendResponse(404,
                CJSON::encode(
                    array(
                        'error' => "Pisco no encontrado",
                    )
                )
            );
        }
    }

    public function actionCambiarPassword()
    {
        $json = file_get_contents('php://input');
        $post_vars = CJSON::decode($json, true); //true means use associative array
        $model = new CambiarClave();
        $model->attributes = $post_vars;
        Yii::app()->user->id = 1;
        if ($model->validate()) {
            $rol_usuario_id = Yii::app()->params['rol_usuario_id'];
            $changeP = new UserChangePassword;
            $changeP->attributes = $model->getAttributes(array("oldPassword", "password", "verifyPassword"));
            //$model->getAttributes(array("username", "password","superuser"))
            $userExist = User::model()->findByAttributes(array("id" => $model->userId, "superuser" => $rol_usuario_id ));
            if ($userExist) {
                Yii::app()->user->id = $model->userId;
                if ($changeP->validate()) {
                    $new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
                    $new_password->password = UserModule::encrypting($model->password);
                    $new_password->activkey=UserModule::encrypting(microtime().$model->password);
                    $new_password->save();

                    echo CJSON::encode($this->getOtherDataUser($userExist));
                } else {
                    $this->_sendResponse(500,
                        CJSON::encode(
                            array(
                                'error' => $this->getErrrorStrFromModel($changeP),
                            )
                        )
                    );
                }
            } else {
                $this->_sendResponse(404,
                    CJSON::encode(
                        array(
                            'error' => "Usuario No encontrado",
                        )
                    )
                );
            }
        } else {
            $this->_sendResponse(500,
                CJSON::encode(
                    array(
                        'error' => $this->getErrrorStrFromModel($model),
                    )
                )
            );
        }
    }

    public function actionCuponDetalle($id,$userId){
        $model = CuponesDescuento::model()->findByPk($id);
        if ($model) {
            $this->_sendResponse(200, CJSON::encode($this->getOtherDataCupones($model,$userId)));
        } else {
            $this->_sendResponse(404,
                CJSON::encode(
                    array(
                        'error' => "Cupon no encontrado",
                    )
                )
            );
        }
    }

    public function actionMiembroDetalle($id){
        $model = Miembro::model()->findByPk($id);
        if ($model) {
            $this->_sendResponse(200, CJSON::encode($model));
        } else {
            $this->_sendResponse(404,
                CJSON::encode(
                    array(
                        'error' => "Miembro no encontrado",
                    )
                )
            );
        }
    }

    public function actionRegistrarse()
    {
        $json = file_get_contents('php://input');
        $model = new User;
        $model->superuser = 3;
        $model->status = 1;
        $model->setScenario('Create');
        $post_vars = CJSON::decode($json, true); //true means use associative array
        $model->attributes = $post_vars;
        $model->activkey=UserModule::encrypting(microtime().$model->password);
        $model->password=UserModule::encrypting($model->password);

        $profile=new Profile;
        $profile->attributes=$post_vars;

        //$modelTransaction = $model->dbConnection->beginTransaction();
        try {

            if ($model->validate()) {
                if ($profile->validate()) {
                    if ($model->save()) {
                        //$modelTransaction->commit();
                        $profile->setAttribute("user_id", $model->id);
                        //print_r($profile->getAttributes());
                        if ($profile->save()) {
                            //echo CJSON::encode($model);
                            echo CJSON::encode($this->getOtherDataUser($model));
                            //Agregar Rol
                            $modelAuthAssignment = new AuthAssignment;
                            $modelAuthAssignment->itemname = Yii::app()->params['rol_usuario'];
                            $modelAuthAssignment->userid = $model->id;
                            $modelAuthAssignment->data = "N;";
                            $modelAuthAssignment->save();

                            //$modelTransaction->commit();

                            $sendTo = $model->email;
                            $fromName = $model->email;
                            $exito = Yii::app()->myClass->sendWelcomeMessage($sendTo, $fromName, "Bienvenido a Piscos Magic");
                        }
                    } else {
                        $this->_sendResponse(500,
                            CJSON::encode(
                                array(
                                    'error' => "Error al guardar el usuario",
                                )
                            )
                        );
                    }
                } else {
                    $this->_sendResponse(500,
                        CJSON::encode(
                            array(
                                'error' => $this->getErrrorStrFromModel($profile),
                            )
                        )
                    );

                }
            } else {
                $this->_sendResponse(500,
                    CJSON::encode(
                        array(
                            'error' => $this->getErrrorStrFromModel($model),
                        )
                    )
                );
            }

        } catch (Exception $e) {
            //$modelTransaction->rollBack();

            $this->_sendResponse(500,
                CJSON::encode(
                    array(
                        'error' => $e->getMessage(),
                    )
                )
            );
        }
    }

    public function actionGuardar_codigo_cupon()
    {
        $json = file_get_contents('php://input');
        $post_vars = CJSON::decode($json, true); //true means use associative array
        $model = new CuponesCodigosGenerados();
        $model->attributes = $post_vars;

        if ($model->validate()) {
            $userExist = User::model()->findByPk($model->userId);
            if($userExist){
                $cuponDescuentoExist = CuponesDescuento::model()->findByPk($model->cupon_descuento_id);
                if($cuponDescuentoExist){
                    if($model->save()){
                        echo CJSON::encode($model);
                    }else{
                        $this->_sendResponse(500,
                            CJSON::encode(
                                array(
                                    'error' => "Error al guardar el cupon",
                                )
                            )
                        );
                    }
                }else{
                    $this->_sendResponse(404,
                        CJSON::encode(
                            array(
                                'error' => "Cupon de descuento no encontrado",
                            )
                        )
                    );
                }

            }else{
                $this->_sendResponse(404,
                    CJSON::encode(
                        array(
                            'error' => "Usuario No encontrado",
                        )
                    )
                );
            }
        } else {
            $this->_sendResponse(500,
                CJSON::encode(
                    array(
                        'error' => $this->getErrrorStrFromModel($model),
                    )
                )
            );
        }
        /**
         * Es Necesario los parametros Usuario, Cupon ID y codigo de cupon
         */
    }

    // Actions
    public function actionList()
    {
        $isCommmonResponse = true;
        $criteria=new CDbCriteria;
        $criteria->order = "id DESC";

        switch ($_GET['model']) {

            case 'categorias_noticia':
                $models = CategoriasNoticia::model()->findAll($criteria);
                break;

            case 'noticias':
                if(isset($_GET["categoriaId"])){
                    $categoriaId = $_GET["categoriaId"];
                    $criteria->addCondition('t.categoriaId=' . $categoriaId);
                }
                $models = Noticia::model()->findAll($criteria);
                break;

            case 'banners':
                $models = Banner::model()->findAll($criteria);
                break;
            case 'regiones':
                $models = Region::model()->findAll($criteria);
                break;
            case 'categorias_cupones':
                $models = CategoriasCupones::model()->findAll($criteria);
                break;

            case 'cupones_descuento':
                if (isset($_GET["userId"]) AND isset($_GET["catId"])) {
                    $userId = $_GET["userId"];
                    $categoriaId = $_GET["catId"];
                    $criteria->addCondition('t.userId=' . $userId);
                    $cuponesUtilizados = CuponesCodigosGenerados::model()->findAll($criteria);

                    $criteriaParaCupones=new CDbCriteria;
                    $criteriaParaCupones->addCondition('t.categoriaId=' . $categoriaId);
                    $cupones = CuponesDescuento::model()->findAll($criteriaParaCupones);

                    $models = array();
                    foreach($cupones as $cupon){
                        $pasar = false;
                        foreach($cuponesUtilizados as $cuponUtilizado){
                            //print_r($cupon->id);
                            //print_r($cuponUtilizado->cupon_descuento_id);
                            if($cupon->id == $cuponUtilizado->cupon_descuento_id){
                                $pasar = true;
                            }
                        }
                        if(!$pasar){
                            $models[] = $this->getOtherDataCupones($cupon,$userId);
                        }
                    }
                    //TODO: Agregar una variable GET del usuario_id
                    //TODO: Falta agregar el campo activo a Cupones de Descuento
                    //TODO: consulta los cupones activos
                    //TODO: consultar los codigos del usuario de cupon de acuerdo al cupon activo con foreach()
                }else{
                    $this->_sendResponse(500,
                        CJSON::encode(array('error' => 'Posiblemente falten los parametros userId y catId')));
                }
                break;
            case 'generar_codigo_cupon':
                $isCommmonResponse = false;
                Yii::import('ext.coupon', true);
                $options = array("mask" => "XXXX-XXXX");
                $coupons = coupon::generate_coupons(1, $options);

                $cuponGenerado = "";
                foreach ($coupons as $key => $value) {
                    $cuponGenerado = $value;
                }

                $this->_sendResponse(200, CJSON::encode(
                    array("codigo"=>$cuponGenerado)));
                break;
            case 'radios':
                $models = Radio::model()->findAll($criteria);
                break;

            case 'piscos':
                //$criteria->join = "LEFT join fotos f ON f.piscoId = t.id ";
                $criteria->join = "join region r ON r.id = t.regionId ";
                $criteria->addCondition('t.activo=1');
                $criteria->addCondition('t.aprobado=1');
                if (isset($_REQUEST['sSearch']) && isset($_REQUEST['sSearch']{0})) {
                    //echo "test>> ".$_REQUEST['sSearch'];
                    //$criteria->addSearchCondition('name', $_REQUEST['sSearch'], true);
                    //$criteria->addSearchCondition('regionId', $_REQUEST['sSearch'], true);
                    $criteria->addSearchCondition('name', $_REQUEST['sSearch'], true, 'AND', 'LIKE');
                    $criteria->addSearchCondition('regionId', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
                    $criteria->addSearchCondition('r.nombre', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
                    //$criteria->addSearchCondition('regionId', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
                }
                $totalRegistros = Pisco::model()->count($criteria);

                // maximo por pagina
                $limit = 10;
                $criteria->limit = $limit;

                // pagina pedida
                if(isset($_GET["page"])){
                    $pag = (int) $_GET["page"];
                }else{
                    $pag = 1;
                }

                if ($pag < 1)
                {
                    $pag = 1;
                }
                $criteria->offset = ($pag-1) * $limit;
                $models = Pisco::model()->findAll($criteria);

                $total_paginas = ceil($totalRegistros / $limit);

                //$models = Pisco::model()->findAll($criteria);
                $modelsTemp = $models;
                $models = array();
                foreach($modelsTemp as $model){
                    /*$result = $model->getAttributes();
                    $result["fotosSlider"] = $model->fotoses;
                    $result["horarios"] = $model->horarios;
                    $result["total_paginas"] = $total_paginas;
                    $models[] = $result;*/
                    $models[] = $this->getOtherDataPisco($model,$total_paginas);
                }
                break;
            case 'gastronomia':
                $criteria->join = "LEFT join pisco p ON p.id = t.piscoId ";
                if (isset($_REQUEST['sSearch']) && isset($_REQUEST['sSearch']{0})) {
                    //echo "test>> ".$_REQUEST['sSearch'];
                    $criteria->addSearchCondition('titulo', $_REQUEST['sSearch'], true);
                    $criteria->addSearchCondition('p.name', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
                }
                $totalRegistros = Gastronomia::model()->count($criteria);

                // maximo por pagina
                $limit = 10;
                $criteria->limit = $limit;

                // pagina pedida
                if(isset($_GET["page"])){
                    $pag = (int) $_GET["page"];
                }else{
                    $pag = 1;
                }

                if ($pag < 1)
                {
                    $pag = 1;
                }
                $criteria->offset = ($pag-1) * $limit;
                $models = Gastronomia::model()->findAll($criteria);

                $total_paginas = ceil($totalRegistros / $limit);

                //$models = Pisco::model()->findAll($criteria);
                $modelsTemp = $models;
                $models = array();
                foreach($modelsTemp as $model){
                    /*$result = $model->getAttributes();
                    $result["fotosSlider"] = $model->fotoses;
                    $result["horarios"] = $model->horarios;
                    $result["total_paginas"] = $total_paginas;
                    $models[] = $result;*/
                    $models[] = $this->getOtherDataGastronomia($model,$total_paginas);
                }
                break;
            case 'favoritos':
                if (isset($_GET["userId"])) {
                    $userId = $_GET["userId"];
                    $criteria->addCondition('t.userId=' . $userId);
                    $models = Favoritos::model()->findAll($criteria);

                    $modelsTemp = $models;
                    $models = array();
                    foreach($modelsTemp as $model){
                        $result = $model->getAttributes();
                        $result["pisco"] = $model->pisco;
                        $models[] = $result;
                    }
                }
                break;
            case 'miembros':
                    $models = Miembro::model()->findAll();
                break;

            default:
                //$models = Noticia::model()->findAll();
                break;
        }

          //print_r($models);

        // Did we get some results?
        if($isCommmonResponse){
        if (empty($models)) {
            // No
            $this->_sendResponse(404,
                CJSON::encode(array('error' => 'No items where found for model ' . $_GET["model"])));
        } else {
            // Prepare response
            /*$rows = array();
            foreach ($models as $model)
                $rows[] = $model->attributes;*/
            // Send the response
            $this->_sendResponse(200, CJSON::encode($models));
        }
    }
    }

    private function getOtherDataPisco($model,$total_paginas){
        /* @var $model Pisco */
        $result = $model->getAttributes();
        $result["fotosSlider"] = $model->fotoses;
        $result["horarios"] = $model->horarios;
        $result["region"] = $model->region;
        //$result["region"] = array("id"=>$model->region->id,"nombre"=>$model->name);
        //$result["baseUrl"] = Yii::app()->getBaseUrl(true);

        if($total_paginas){ //Para el caso que se valida nada mas un registro
            $result["total_paginas"] = $total_paginas;
        }

        return $result;
    }

    private function getOtherDataGastronomia($model,$total_paginas){
        $result = $model->getAttributes();

        if($total_paginas){ //Para el caso que se valida nada mas un registro
            $result["total_paginas"] = $total_paginas;
        }
        return $result;
    }

    private function getOtherDataUser($model){
        $result = $model->getAttributes();
        $profileFields=ProfileField::model()->forOwner()->sort()->findAll();
        if ($profileFields) {
            foreach($profileFields as $field) {
                //echo $field->varname."<br>";
                $result[$field->varname] = (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname)));

            }
        }
        return $result;
    }

    private function getOtherDataCupones($model,$userId){
        $result = $model->getAttributes();
        $result["pisco"] = $model->pisco;
        $result["categoriaCupon"] = $model->categoriaCupon;
        $deshabilitarCupon = false;
        if(CuponesCodigosGenerados::model()->findByAttributes(array("cupon_descuento_id"=>$model->id,"userId"=>$userId))){
            $deshabilitarCupon = true;
        }
        $result["deshabilitarCupon"] = $deshabilitarCupon;

        return $result;
    }

    private function _sendResponse($status = 200, $body = '', $content_type = 'application/json')
    {
        // set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type);

        // pages with body are easy
        if ($body != '') {
            // send the body
            echo $body;
        } // we need to create the body if none is passed
        else {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch ($status) {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on
            // (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templated in a real-world solution
            $body = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
</head>
<body>
    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
    <p>' . $message . '</p>
    <hr />
    <address>' . $signature . '</address>
</body>
</html>';

            echo $body;
        }
        Yii::app()->end();
    }

    private function _getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    public function convertModelToArray($models) {
        if (is_array($models))
            $arrayMode = TRUE;
        else {
            $models = array($models);
            $arrayMode = FALSE;
        }

        $result = array();
        foreach ($models as $model) {
            $attributes = $model->getAttributes();
            $relations = array();
            foreach ($model->relations() as $key => $related) {
                echo ">>".$key;
                if ($model->hasRelated($key)) {
                    $relations[$key] = convertModelToArray($model->$key);
                }
            }
            $all = array_merge($attributes, $relations);

            if ($arrayMode) {
                array_push($result, $all);
            } else {
                $result = $all;
            }
        }
        return $result;
    }

    private function getErrrorStrFromModel($model){
        $errorStr = "";
        foreach($model->getErrors() as $error){
            $errorStr .= $error[0]." ";
            //print_r($error);
        }

        return $errorStr;
    }
}