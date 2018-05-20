<?php

/**
 * This is the model class for table "cupones_descuento".
 *
 * The followings are the available columns in table 'cupones_descuento':
 * @property integer $id
 * @property string $name
 * @property string $imageUrl
 * @property string $descripcion
 * @property integer $piscoId
 * @property integer $categoriaId
 * @property string $expirationDate
 *
 * The followings are the available model relations:
 * @property CategoriasCupones $categoriaCupon
 * @property Pisco $pisco
 */
class CuponesDescuento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cupones_descuento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('name, imageUrl, piscoId, categoriaId,descripcion,expirationDate', 'required','on' => 'Create'),
            array('name, piscoId, categoriaId,descripcion,expirationDate','required','on' => 'Update'),
			array('piscoId, categoriaId', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('imageUrl', 'length', 'max'=>250),
			array('descripcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, imageUrl, descripcion, piscoId, categoriaId,expirationDate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'categoriaCupon' => array(self::BELONGS_TO, 'CategoriasCupones', 'categoriaId'),
			'pisco' => array(self::BELONGS_TO, 'Pisco', 'piscoId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'imageUrl' => 'Image Url',
			'descripcion' => 'Descripcion',
			'piscoId' => 'Pisco',
			'categoriaId' => 'Categoria Cupon',
            'expirationDate' => 'Fecha de expiración',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('imageUrl',$this->imageUrl,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('piscoId',$this->piscoId);
		$criteria->compare('categoriaId',$this->categoriaId);
        $criteria->compare('expirationDate',$this->expirationDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CuponesDescuento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave()
    {
        //parent::beforesave();
        /*$var = '20/04/2012';
        $date = str_replace('/', '-', $var);
        $this->expirationDate = date('Y-m-d', strtotime($date));*/

        if (parent::beforeSave()) {
            // override time with 23:59:59
            $var = '20/04/2012';
            $date = str_replace('/', '-',  $this->expirationDate);
            $this->expirationDate = date('Y-m-d H:i:s', strtotime($date));
            return true;
        }
        return false;
    }

    public function afterFind()
    {
        //PHP dates are displayed as dd/mm/yyyy
        //MYSQL dates are stored as yyyy-mm-dd

        $creation_date= new DateTime($this->expirationDate);
        $this->expirationDate = $creation_date->format("d/m/Y H:i:s");

        parent::afterFind();
        return true;
    }
}
