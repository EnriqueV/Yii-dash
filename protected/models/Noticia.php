<?php

/**
 * This is the model class for table "noticia".
 *
 * The followings are the available columns in table 'noticia':
 * @property integer $id
 * @property string $titulo
 * @property string $text
 * @property string $creado
 * @property integer $categoriaId
 * @property string $imageUrl
 *
 * The followings are the available model relations:
 * @property CategoriasNoticia $categoria
 */
class Noticia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'noticia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, text, categoriaId, imageUrl', 'required','on' => 'Create'),
			array('titulo, text, categoriaId', 'required','on' => 'Update'),
           /* array('image', 'required','on' => 'Create'),
            array('', 'required','on' => 'Update'), //Se deshabilita para poder manejar el codigo de cambio de imagen*/
			array('categoriaId', 'numerical', 'integerOnly'=>true),
			array('titulo', 'length', 'max'=>75),
			array('imageUrl', 'length', 'max'=>250),
            array('creado', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'Create'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, titulo, text, creado, categoriaId, imageUrl', 'safe', 'on'=>'search'),
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
			'categoria' => array(self::BELONGS_TO, 'CategoriasNoticia', 'categoriaId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'titulo' => 'Titulo',
			'text' => 'Text',
			'creado' => 'Fecha',
			'categoriaId' => 'Categoria',
			'imageUrl' => 'Image Url',
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
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('creado',$this->creado,true);
		$criteria->compare('categoriaId',$this->categoriaId);
		$criteria->compare('imageUrl',$this->imageUrl,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Noticia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
