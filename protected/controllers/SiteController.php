<?php

class SiteController extends RController
{

    /*public function filters()
    {
        return array(
            'rights',
        );
    }*/

    public function allowedActions()
    {
        return '*';
    }
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
    {
        if (Yii::app()->user->isGuest) {
            // renders the view file 'protected/views/site/index.php'
            // using the default layout 'protected/views/layouts/main.php'
            $this->layout = 'landing';
            //$this->render('index');

            $model = new User;
            $model->setScenario('Create');
            $profile = new Profile;
            $registroExitoso = isset($_GET["registroExitoso"]) ? true : false;

            if (isset($_POST['User'])) {
                $model->attributes = $_POST['User'];
                $rol = Yii::app()->params['rol_cliente']; //Valor del rol para clientes

                $model->superuser = 2; //De tipo Cliente
                $model->status = User::STATUS_NOT_APPROVED; // No aprobado

                $profile->attributes = $_POST['Profile'];
                $profile->user_id = 0;

                $model->activkey = Yii::app()->getModule('user')->encrypting(microtime() . $model->password);
                if ($model->validate() && $profile->validate()) {
                    $model->password = Yii::app()->getModule('user')->encrypting($model->password);
                    if ($model->save()) {
                        $profile->user_id = $model->id;
                        $profile->save();

                        //Agregar Rol
                        $modelAuthAssignment = new AuthAssignment;
                        $modelAuthAssignment->itemname = $rol;
                        $modelAuthAssignment->userid = $model->id;
                        $modelAuthAssignment->data = "N;";
                        $modelAuthAssignment->save();
                    }
                    //$this->redirect(array('view','id'=>$model->id));
                    $this->redirect(array('index','registroExitoso'=>1));
                    //$model = new User;
                   // $model->setScenario('Create');
                   // $profile = new Profile;
                   // $registroExitoso = true;
                } else $profile->validate();
            }

            $this->render('registrarse', array(
                'model' => $model,
                'profile' => $profile,
                'registroExitoso' => $registroExitoso,

            ));
        } else {
            $this->render('index');
        }
    }

    public function actionEmail(){
        //echo "TESTE";
        Yii::import('ext.phpmailer.phpmailer', true);
        Yii::import('ext.phpmailer.smtp', true);

        $mail = Yii::app()->params['mail'];

        $username = $mail['username'];
        $password = $mail['password'];
        $sendTo = "albert.hugo@hotmail.com";

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        //$mail->SMTPDebug = 2;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = $username;
        $mail->Password = $password;

        $mail->From = "lhugo.calderon@gmail.com";
        $mail->FromName = "TESTE";
        $mail->Subject = "subject";
        //$mail->cc = "jamcgroup@gmail.com";
        $mail->AltBody = "";

        //$emailText = "Hola mundo";
        $body = file_get_contents(Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR ."template.html");

        $mail->MsgHTML($body);

        $mail->AddAddress($sendTo);
        $mail->IsHTML(true);
        if($mail->Send()){
           echo "Enviado";
        }else{
            echo "No enviado";
        }
        echo Yii::getPathOfAlias('webroot');
    }


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{   $model=new ContactForm;
        if(Yii::app()->getRequest()->getIsAjaxRequest()){
            if(isset($_POST['ContactForm']))
            {
                $model->attributes=$_POST['ContactForm'];

                Yii::import('ext.phpmailer.phpmailer', true);
                Yii::import('ext.phpmailer.smtp', true);

                $mail = Yii::app()->params['mail'];

                $username = $mail['username'];
                $password = $mail['password'];
                $sendTo = $mail['adminEmail'];

                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                //$mail->SMTPDebug = 2;
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->Username = $username;
                $mail->Password = $password;

                $mail->From = $model->email;
                $mail->FromName = $model->name;
                $mail->Subject = $model->subject;
                $mail->cc = "jamcgroup@gmail.com";
                $mail->AltBody = "";

                $emailText = "";
                foreach ($model->attributes as $key => $value) {
                    if (isset($key) AND $value != "") {
                        $emailText .= "<br>".$key. ": ". $value;
                    }
                }

                $mail->MsgHTML($emailText);

                $mail->AddAddress($sendTo);
                $mail->IsHTML(true);
                if($mail->Send()){
                    $return_arr["frm_check"] = 'success';
                    $return_arr["msg"] = "Mensaje enviado con exito";
                }else{
                    $return_arr["frm_check"] = 'error';
                    $return_arr["msg"] = "Ocurrio un error al enviar el mensaje";
                }

                echo json_encode($return_arr);


                /*
                $return_arr["frm_check"] = 'error';
                $return_arr["msg"] = "Este es un mensaje de error";
                echo json_encode($return_arr);*/
            }

        }
        /*
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));*/
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

    /**
     * Displays the login page
     */
    public function actionRegistrarse()
    {
        $model=new User;
        $model->setScenario('Create');
        $profile=new Profile;
        $registroExitoso = false;

        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            $rol =  Yii::app()->params['rol_cliente']; //Valor del rol para clientes

            $model->superuser = 2; //De tipo Cliente
            $model->status = User::STATUS_NOT_APPROVED;  // No aprobado

            $profile->attributes=$_POST['Profile'];
            $profile->user_id=0;

            $model->activkey=Yii::app()->getModule('user')->encrypting(microtime().$model->password);
            if($model->validate() && $profile->validate()) {
                $model->password=Yii::app()->getModule('user')->encrypting($model->password);
                if($model->save()) {
                    $profile->user_id=$model->id;
                    $profile->save();

                    //Agregar Rol
                    $modelAuthAssignment = new AuthAssignment;
                    $modelAuthAssignment->itemname = $rol;
                    $modelAuthAssignment->userid = $model->id;
                    $modelAuthAssignment->data = "N;";
                    $modelAuthAssignment->save();
                }
                //$this->redirect(array('view','id'=>$model->id));
                //print_r($model);
                $model = new User;
                $model->setScenario('Create');
                $profile = new Profile;
                $registroExitoso = true;
            } else $profile->validate();
        }

        $this->render('registrarse',array(
            'model'=>$model,
            'profile'=>$profile,
            'registroExitoso'=>$registroExitoso,

        ));
    }

    /* @var $existe CodigoRecuperarClave */
    public function actionRecuperarClave($codigo,$procesoExitoso = false)
    {
        $this->layout = "//layouts/login";
        $existe = CodigoRecuperarClave::model()->findByAttributes(array("codigo" => $codigo));
        $model = new RecuperarClave();
        if ($existe) {
            if (isset($_POST['RecuperarClave'])) {
                $model->attributes = $_POST['RecuperarClave'];
                if ($model->password != $model->repassword) {
                    $model->addError("repassword", "la claves no coinciden");
                } else {
                    $user = User::model()->findByPk($existe->userId);
                    $user->activkey = UserModule::encrypting(microtime() . $model->password);
                    $user->password = UserModule::encrypting($model->password);
                    if($user->save()){
                        $procesoExitoso = true;
                        //$this->redirect(array('index'));
                        $this->redirect(array('recuperarClave','codigo'=>$codigo,'procesoExitoso'=>1));
                    }
                }
            }
            if($procesoExitoso){
                $existe->delete();
            }
            $this->render('recuperarClave', array(
                'model' => $model,
                'procesoExitoso' => $procesoExitoso,
            ));
        } else {
            echo "Ocurrio un error, posiblemente el codigo no exista o ha expirado, solicite el cambio de contrase&ntilde;a nuevamente desde la Aplicaci&oacuten.";
        }
    }

    public function actionWelcomeEmail(){

       /* $sendTo = "albert.hugo@hotmail.com";
        $fromEmail = "lhugo.calderon@gmail.com";
        $exito = Yii::app()->myClass->sendWelcomeMessage($sendTo, $fromEmail, "Hugo", "Recuperar Clave");
        echo $exito;*/
        echo Yii::app()->getBaseUrl(true);

    }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}