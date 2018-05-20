<?php

class CuponesCodigosGeneradosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CuponesCodigosGenerados;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CuponesCodigosGenerados']))
		{
			$model->attributes=$_POST['CuponesCodigosGenerados'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
    /** The followings are the available model relations:
    * @property CuponesCodigosGenerados $codigoDB
    * @property CuponesDescuento $cuponDescuentoExiste
    **/
	public function actionIndex()
	{
        $model=new CanjearCodigo;
        $codigoEncontrado = false;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['CanjearCodigo']))
        {
           $model->attributes=$_POST['CanjearCodigo'];
           $esBotonCanjear = isset($_POST['yt1']) ? true : false;
            if ($model->validate()) {
                $codigoUsuario = CuponesCodigosGenerados::model()->findByAttributes(array("codigo" => $model->codigo));
                if ($codigoUsuario) {
                    //print_r($codigoDB->cupon_descuento_id);
                    //$cuponDescuentoExiste = CuponesDescuento::model()->findByPk($codigoUsuario->cupon_descuento_id);
                    $criteria = new CDbCriteria;
                    $criteria->join='INNER JOIN pisco p ON p.id=t.piscoId';
                    $criteria->addCondition('p.userId=' . Yii::app()->user->id);
                    $criteria->addCondition('t.id=' . $codigoUsuario->cupon_descuento_id);

                    $cuponDescuentoExiste = CuponesDescuento::model()->findAll($criteria);
                    if(sizeof($cuponDescuentoExiste) > 0){
                        $cuponDescuentoExiste = $cuponDescuentoExiste[0];
                       // echo $cuponDescuentoExiste->expirationDate;
                        $currentDate = date("Y-m-d H:i:s");
                        if ($currentDate < $cuponDescuentoExiste->expirationDate) {
                            if (!$esBotonCanjear) {
                                //Disponible
                                $fechaParaUsuario = date('d/m/Y H:i', strtotime($cuponDescuentoExiste->expirationDate));
                                $codigoEncontrado = array(
                                    true,
                                    "<strong>Código encontrado</strong><br><br>" .
                                    "<b>Fecha Expiracion:</b> " . $fechaParaUsuario . "<br>" .
                                    "<b>Descripción:</b> " . $cuponDescuentoExiste->descripcion . "<br>"
                                );
                            }else{
                                if($codigoUsuario->delete()){
                                    $model=new CanjearCodigo;
                                    $codigoEncontrado = array(
                                        true,"Cúpon canjeado exitosamente");
                                }else{
                                    $codigoEncontrado = array(
                                        false,"Ocurrio un error al realizar la operación");
                                }
                            }
                        } else {
                            $codigoEncontrado = array(false, "El cupon de descuento ya expiró");
                        }
                    }else{
                        $codigoEncontrado = array(false, "El cupon de descuento no existe o ya no se encuentra activo");
                    }
                    //CuponesDescuento::model()->findByPk($codigoEncontrado->cupon_descuento_id);
                } else {
                    $codigoEncontrado = array(false, "Código incorrecto");
                }
            }
        }

        $this->render('index',array(
            'model'=>$model,
            'codigoEncontrado'=>$codigoEncontrado
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CuponesCodigosGenerados the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CuponesCodigosGenerados::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CuponesCodigosGenerados $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cupones-codigos-generados-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
