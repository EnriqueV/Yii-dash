<?php

class GastronomiaController extends Controller
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
			array('allow',
				'actions'=>array('index','create','update','view','delete'),
				'users'=>array('admin'),
			),
			array('allow',
				'actions'=>array('index','create','update','view','delete'),
				'users'=>array('@'),
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
		$model=new Gastronomia;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gastronomia']))
		{
			$model->attributes=$_POST['Gastronomia'];
			/*if($model->save())
				$this->redirect(array('view','id'=>$model->id));*/
            $model->imageUrl = CUploadedFile::getInstance($model, 'imageUrl');
            if ($model->validate()) {

                $imageWidthRequired = Yii::app()->params['fotoGastronomiaDimensions']['width'];
                $imageHeightRequired = Yii::app()->params['fotoGastronomiaDimensions']['height'];
                $imageInfo = getimagesize($model->imageUrl->getTempName());
                $imageWidth = $imageInfo[0];
                $imageHeight = $imageInfo[1];

                //if ($imageWidth == $imageWidthRequired AND $imageHeight == $imageHeightRequired) {
                $rnd = $this->generateRandomNumber(); // generate random number between 0-9999
                $fileName = "{$rnd}_{$model->imageUrl->name}"; // random number + file name
                if ($model->save() AND !$model->getErrors()) {
                    $model->imageUrl->saveAs($this->getPatchGallery() . $fileName);
                    $model->imageUrl = $fileName;
                    $model->save();
                    $this->redirect(array('view', 'id' => $model->id));
                }
                /* } else {
                     $model->addError('image', "La imagen debe tener un ancho de $imageWidthRequired y un alto de $imageHeightRequired");
                 }*/

            }
		}

		$this->render('create',array(
			'model'=>$model
		));
	}

    private function generateRandomNumber()
    {
        return rand(0,9999);
    }

    private function getPatchGallery()
    {
        return Yii::app()->basePath . '/../images/gastronomia/';
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $oldImageName = $model->imageUrl;


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Gastronomia'])) {
            $model->attributes = $_POST['Gastronomia'];
            /*if($model->save())
                $this->redirect(array('view','id'=>$model->id));*/
            if ($model->validate()) {
                //print_r($model->getAttributes());
                $model->imageUrl = CUploadedFile::getInstance($model, 'imageUrl');
                if ($model->imageUrl) {

                    $imageWidthRequired = Yii::app()->params['fotoGastronomiaDimensions']['width'];
                    $imageHeightRequired = Yii::app()->params['fotoGastronomiaDimensions']['height'];
                    $imageInfo = getimagesize($model->imageUrl->getTempName());
                    $imageWidth = $imageInfo[0];
                    $imageHeight = $imageInfo[1];

                    //if ($imageWidth == $imageWidthRequired AND $imageHeight == $imageHeightRequired) {
                    $rnd = $this->generateRandomNumber(); // generate random number between 0-9999
                    $fileName = "{$rnd}_{$model->imageUrl->name}"; // random number + file name
                    if ($model->save() AND !$model->getErrors()) {
                        $model->imageUrl->saveAs($this->getPatchGallery() . $fileName);
                        //Eliminar la imagen anterior
                        unlink($this->getPatchGallery().$oldImageName);
                        $model->imageUrl = $fileName;
                        $model->save();
                        $this->redirect(array('index'));
                    }
                    /* } else {
                         $model->addError('image', "La imagen debe tener un ancho de $imageWidthRequired y un alto de $imageHeightRequired");
                     }*/
                } else {
                    $model->imageUrl = $oldImageName;
                    $model->save();
                    echo "TEST";
                    ///$this->redirect(array('index'));
                }
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));

    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		/*$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));*/

        $model=Gastronomia::model()->findByPk($id);
        $oldImageName = $model->imageUrl;
        $model->delete();
        //Eliminar imagenes anterior
        unlink($this->getPatchGallery().$oldImageName);

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!Yii::app()->getRequest()->getIsAjaxRequest())
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));

        else echo "{}";
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria = new CDbCriteria;
        // bro-tip: $_REQUEST is like $_GET and $_POST combined
        if (isset($_REQUEST['sSearch']) && isset($_REQUEST['sSearch']{0})) {
            // use operator ILIKE if using PostgreSQL to get case insensitive search
            /*$criteria->addSearchCondition('code', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('name', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('status', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('category', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('type', $_REQUEST['sSearch'], true, 'OR', 'LIKE');*/

            Yii::app()->session['gastronimiaSearch'] = $_REQUEST['sSearch'];
        }

//        $criteria->order = 'id DESC';

        $columns = array(
            array(
                'name' => 'Pisco',
                'type' => 'raw',
                'value' => '$data->pisco->name',

            ),
            'titulo');

        $sort = new EDTSort('Gastronomia', $columns);
        $sort->defaultOrder = 'id';

        $pagination = new EDTPagination();
//        $pagination->setPageSize(10);

        $dataProvider = new CActiveDataProvider('Gastronomia', array(
            'criteria' => $criteria,
            'pagination' => $pagination,
            'sort' => $sort,
        ));

        $columns[] = array(
            'class' => 'EButtonColumn',
            'deleteConfirmation' => Yii::t('models', 'deleteConfirmation'),
            'buttons' => array(
                'view' =>   array(),
                'update' => array(),
                'delete' => array()
            )
        );

        $widget = $this->createWidget('ext.nineinchnick.edatatables.EDataTables', array(
            'id' => 'pisco',
            'htmlOptions' => array('class' => 'table-responsive'),
            'itemsCssClass' => 'table table-striped table-bordered table-condensed items',
            'pagerCssClass' => 'dataTables_paginate paging_full_numbers',
            'dataProvider' => $dataProvider,
            'ajaxUrl' => $this->createUrl('/gastronomia/index?a'),
            'columns' => $columns,
            'datatableTemplate' => "<><'row'<'col-sm-6'l><'col-sm-6'f><'dataTables_toolbar'>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            'registerJUI' => false,
            'options' => array(
                'bJQueryUI' => false,
//                'sPaginationType' => 'bootstrap',
//                'fnDrawCallbackCustom' => "js:function(){\$('a[rel=tooltip]').tooltip(); \$('a[rel=popover]').popover();}",
            ),
            'buttons' => array(
                'refresh' => array(
                    'tagName' => 'a',
                    'label' => '<i class="icon-refresh"></i>',
                    'htmlClass' => 'btn',
                    'htmlOptions' => array('rel' => 'tooltip', 'title' => Yii::t('EDataTables.edt', "Refresh")),
                    'init' => 'js:function(){}',
                    'callback' => 'js:function(e){e.data.that.eDataTables("refresh"); return false;}',
                ),
            ),

        ));

        if (!isset($_REQUEST['a'])) { //&& !Yii::app()->getRequest()->getIsAjaxRequest()
            $this->render('index', array('widget' => $widget,));
            return;
        } else {
            echo json_encode($widget->getFormattedData(intval($_REQUEST['sEcho'])));
            Yii::app()->end();
        }
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Gastronomia('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Gastronomia']))
			$model->attributes=$_GET['Gastronomia'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Gastronomia the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Gastronomia::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Gastronomia $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gastronomia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
