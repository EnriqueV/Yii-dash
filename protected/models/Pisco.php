<?php

/**
 * This is the model class for table "pisco".
 *
 * The followings are the available columns in table 'pisco':
 * @property integer $id
 * @property string $name
 * @property string $latitud
 * @property string $longitud
 * @property string $telefono
 * @property string $direccion
 * @property string $web
 * @property integer $activo
 * @property integer $userId
 * @property integer $ratingGeneral
 * @property string $youtubeUrl
 * @property integer $esDestacado
 * @property integer $aprobado
 * @property integer $regionId
 *
 * The followings are the available model relations:
 * @property CuponesDescuento[] $cuponesDescuentos
 * @property Favoritos[] $favoritoses
 * @property Fotos[] $fotoses
 * @property Gastronomia[] $gastronomias
 * @property Horarios[] $horarioses
 * @property Region $region
 * @property User $user
 */
class Pisco extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pisco';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, activo, userId, esDestacado,regionId', 'required'),
			array('activo, userId, ratingGeneral, esDestacado, aprobado,regionId', 'numerical', 'integerOnly'=>true),
			array('name, web', 'length', 'max'=>150),
			array('latitud, longitud', 'length', 'max'=>400),
			array('telefono', 'length', 'max'=>75),
			array('youtubeUrl', 'length', 'max'=>45),
			array('direccion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, latitud, longitud, telefono, direccion, web, activo, userId, ratingGeneral, youtubeUrl, esDestacado, aprobado', 'safe', 'on'=>'search'),
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
			'cuponesDescuentos' => array(self::HAS_MANY, 'CuponesDescuento', 'piscoId'),
			'favoritoses' => array(self::HAS_MANY, 'Favoritos', 'piscoId'),
			'fotoses' => array(self::HAS_MANY, 'Foto', 'piscoId'),
			'horarios' => array(self::HAS_MANY, 'Horarios', 'piscoId'),
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
            'gastronomias' => array(self::HAS_MANY, 'Gastronomia', 'piscoId'),
            'region' => array(self::BELONGS_TO, 'Region', 'regionId'),
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
			'latitud' => 'Latitud',
			'longitud' => 'Longitud',
			'telefono' => 'Telefono',
			'direccion' => 'Direccion',
			'web' => 'Web',
			'activo' => 'Activo',
			'userId' => 'User',
			'ratingGeneral' => 'Rating General',
			'youtubeUrl' => 'Youtube Url',
			'esDestacado' => 'Es Destacado',
			'aprobado' => 'Aprobado',
            'regionId' => 'Region',
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
		$criteria->compare('latitud',$this->latitud,true);
		$criteria->compare('longitud',$this->longitud,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('web',$this->web,true);
		$criteria->compare('activo',$this->activo);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('ratingGeneral',$this->ratingGeneral);
		$criteria->compare('youtubeUrl',$this->youtubeUrl,true);
		$criteria->compare('esDestacado',$this->esDestacado);
		$criteria->compare('aprobado',$this->aprobado);
        $criteria->compare('regionId',$this->regionId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pisco the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
