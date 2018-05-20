<?php

class BannerController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','admin','delete','view','create','update'),
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
		$model=new Banner;
        $model->setScenario('Create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        if(isset($_POST['Banner']))
        {
            $model->attributes=$_POST['Banner'];
            /*if($model->save())
                $this->redirect(array('view','id'=>$model->id));*/
            $model->imageUrl = CUploadedFile::getInstance($model, 'imageUrl');
            if ($model->validate()) {

                $imageWidthRequired = Yii::app()->params['fotoBannerDimensions']['width'];
                $imageHeightRequired = Yii::app()->params['fotoBannerDimensions']['height'];
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
                    $this->redirect(array('index'));
                }
                /* } else {
                     $model->addError('image', "La imagen debe tener un ancho de $imageWidthRequired y un alto de $imageHeightRequired");
                 }*/

            }
        }

		$this->render('create',array(
			'model'=>$model,
		));
	}

    private function generateRandomNumber()
    {
        return rand(0,9999);
    }

    private function getPatchGallery()
    {
        return Yii::app()->basePath . '/../images/banners/';
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $model->setScenario('Update');
        $oldImageName = $model->imageUrl;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        if(isset($_POST['Banner']))
        {
            $model->attributes=$_POST['Banner'];
            /*if($model->save())
                $this->redirect(array('view','id'=>$model->id));*/
            if ($model->validate()) {

                if($model->imageUrl){
                    $model->imageUrl = CUploadedFile::getInstance($model, 'imageUrl');
                    $imageWidthRequired = Yii::app()->params['fotoBannerDimensions']['width'];
                    $imageHeightRequired = Yii::app()->params['fotoBannerDimensions']['height'];
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
                        $this->redirect(array('index'));
                    }
                    /* } else {
                         $model->addError('image', "La imagen debe tener un ancho de $imageWidthRequired y un alto de $imageHeightRequired");
                     }*/
                }else{
                    $model->imageUrl = $oldImageName;
                    $model->save();
                    $this->redirect(array('index'));
                }
            }
        }

		$this->render('update',array(
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
        $model=Banner::model()->findByPk($id);
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
		/*$dataProvider=new CActiveDataProvider('Banner');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/

        $criteria = new CDbCriteria;
        // bro-tip: $_REQUEST is like $_GET and $_POST combined
        if (isset($_REQUEST['sSearch']) && isset($_REQUEST['sSearch']{0})) {
            // use operator ILIKE if using PostgreSQL to get case insensitive search
            /*$criteria->addSearchCondition('code', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('name', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('status', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('category', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('type', $_REQUEST['sSearch'], true, 'OR', 'LIKE');*/

            Yii::app()->session['bannerSearch'] = $_REQUEST['sSearch'];
        }

//        $criteria->order = 'id DESC';

        $columns = array(
            'descripcion',
            array(
                'name' => 'imageUrl',
                // 'header' => 'imageUrl',
                'sortable' => true,
                'type' => 'raw',
                'value' => 'CHtml::image(Yii::app()->baseUrl . "/images/banners/" . $data->imageUrl, "imagen", array("width" => 260, "height" => 180))',

            ),);

        $sort = new EDTSort('Banner', $columns);
        $sort->defaultOrder = 'id';

        $pagination = new EDTPagination();
//        $pagination->setPageSize(10);

        $dataProvider = new CActiveDataProvider('Banner', array(
            'criteria' => $criteria,
            'pagination' => $pagination,
            'sort' => $sort,
        ));

        $columns[] = array(
            'class' => 'EButtonColumn',
            'deleteConfirmation' => Yii::t('models', 'deleteConfirmation'),
            'buttons' => array(
                'view' => array('options' => array(
                    'style' => 'display:none;',
                ),),
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
            'ajaxUrl' => $this->createUrl('/banner/index?a'),
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
		$model=new Banner('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Banner']))
			$model->attributes=$_GET['Banner'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Banner the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Banner::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Banner $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='banner-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
