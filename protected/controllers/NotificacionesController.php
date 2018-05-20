<?php

class NotificacionesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
    public $API_ACCESS_KEY = '';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model = new NotificacionesForm;
        if(isset($_POST['NotificacionesForm']))
        {
            $model->attributes=$_POST['NotificacionesForm'];
            if ($model->validate()) {
                $messageBody = $model->mensaje;
                $usuarios = User::model()->findAll("android_id IS NOT NULL");
                //define( 'API_ACCESS_KEY', 'AAAASMO2RGI:APA91bGuZt5WUnZ0mE_Pr1w_uorfxeHfZmaIQHUTVrqkAby9XhbK2KEpMNLXygXZElT20Y3t0mPWewYfrwP4bUr42eHNJTzqoLMtSDINovLmGa5fyEI62IfZ3Sh6jINGqLrF0k9R3CD1' );
                if($this->API_ACCESS_KEY != ''){
                    foreach($usuarios as $usuario){
                        //$this->sendMessangeToEmployerAndroid($messageBody,$usuario->android_id);
                        $this->sendMessangeToEmployerAndroid($messageBody,"$2a$10$2HnySom99k6fOoyOVQWXRu570DTIdb8qsKBJ8dgrQS/41bDfPaNhe");
                    }
                }else{
                 echo "API_ACCESS_KEY no configurado";
                }
            }
        }
        $this->render('index', array('model' => $model));
	}

    private function sendMessangeToEmployerAndroid($messageBody, $registrationIds)
    {

        $msg = array
        (
            'body' 	=> $messageBody,
            'title'	=> 'Title Of Notification',
            'icon'	=> 'myicon',#Default Icon
            'sound' => 'mySound'#Default sound
        );
        $fields = array
        (
            'to'		=> $registrationIds,
            'notification'	=> $msg
        );


        $headers = array
        (
            'Authorization: key=' . $this->API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        #Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        #Echo Result Of FireBase Server
        echo $result;
    }

}
