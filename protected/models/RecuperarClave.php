<?php
/**
 * Created by PhpStorm.
 * User: PERSONAL
 * Date: 28/11/17
 * Time: 11:26
 */
class RecuperarClave extends CFormModel
{
    public $password;
    public $repassword;

    public function rules() {
        return  array(
            array('password,repassword', 'required')
        );
    }


    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'password' => 'Inserte la nueva clave',
            'repassword' => 'Repita la clave'
        );
    }
}