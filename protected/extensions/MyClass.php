<?php
/**
 * Created by PhpStorm.
 * User: PERSONAL
 * Date: 17/10/17
 * Time: 1:38
 */

class MyClass extends CApplicationComponent {

    public function isAdmin() {
        return Yii::app()->user->role == Yii::app()->params['rol_admin'];
    }
    public function isClient() {
        return Yii::app()->user->role == Yii::app()->params['rol_cliente'];
    }


    public function getNamesFromUser($model){
        $varNames = "";
        $profileFields=ProfileField::model()->forOwner()->sort()->findAll();
        if ($profileFields) {
            foreach($profileFields as $field) {
                $varNames .=" ". (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname)));

            }
        }
        return $varNames;
    }


    public function sendEmail($sendTo,$fromName,$subject,$body){
        Yii::import('ext.phpmailer.phpmailer', true);
        Yii::import('ext.phpmailer.smtp', true);

        $mail = Yii::app()->params['mail'];

        $username = $mail['username'];
        $password = $mail['password'];
        //$sendTo = "albert.hugo@hotmail.com";

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        //$mail->SMTPDebug = 2;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = $username;
        $mail->Password = $password;

        $mail->From = $username;
        $mail->FromName = $fromName;
        $mail->Subject = $subject;
        //$mail->cc = "jamcgroup@gmail.com";
        $mail->AltBody = "";

        //$emailText = "Hola mundo";
        //$body = file_get_contents(Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR ."template.html");

        $mail->MsgHTML($body);

        $mail->AddAddress($sendTo);
        $mail->IsHTML(true);
        if($mail->Send()){
            return true;
        }else{
            return false;
        }
    }


    public function sendWelcomeMessage($sendTo,$fromName,$subject){
        $variables = array();
        //$variables['baseUrl'] = str_replace("/index.php/site/welcomeemail","/email",$_SERVER['SERVER_NAME'].$_SERVER["PHP_SELF"])."/";
        $variables['baseUrl'] = Yii::app()->getBaseUrl(true)."/email/";
        $variables['content'] = file_get_contents("email/welcome.php");
        $template = file_get_contents("email/template.php");

        //echo $variables['baseUrl'];
        foreach($variables as $key => $value)
        {
            $template = str_replace('{{'.$key.'}}', $value, $template);
        }
        return $this->sendEmail($sendTo,$fromName,$subject,utf8_decode($template));
    }

    public function sendCodeRecoveryAccountMessage($sendTo,$fromName,$subject,$url){
        $variables = array();
        //$variables['baseUrl'] = str_replace("/index.php/site/welcomeemail","/email",$_SERVER['SERVER_NAME'].$_SERVER["PHP_SELF"])."/";
        $variables['baseUrl'] = Yii::app()->getBaseUrl(true)."/email/";
        $variables['content'] = "<p>Para recuperar su cuenta presione el siguiente enlace <a href ='".$url."'>Click para abrir el enlace</a></p><br>";
        $template = file_get_contents("email/template.php");

        //echo $variables['baseUrl'];
        foreach($variables as $key => $value)
        {
            $template = str_replace('{{'.$key.'}}', $value, $template);
        }
        return $this->sendEmail($sendTo,$fromName,$subject,utf8_decode($template));
    }

}