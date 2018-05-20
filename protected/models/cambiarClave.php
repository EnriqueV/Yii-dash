<?php
/**
 * Created by PhpStorm.
 * User: PERSONAL
 * Date: 28/11/17
 * Time: 11:26
 */
class CambiarClave extends CFormModel
{
    public $userId;
    public $oldPassword;
    public $password;
    public $verifyPassword;

    public function rules() {
        return  array(
            array('userId, oldPassword,password,verifyPassword', 'required'),
            array('userId', 'numerical', 'integerOnly'=>true),
        );
    }


}