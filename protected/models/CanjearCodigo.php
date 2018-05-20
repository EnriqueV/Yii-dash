<?php
/**
 * Created by PhpStorm.
 * User: PERSONAL
 * Date: 28/11/17
 * Time: 11:26
 */
class CanjearCodigo extends CFormModel
{
    public $codigo;

    public function rules() {
        return  array(
            array('codigo', 'required')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'codigo' => 'Código de cupón',
        );
    }
}