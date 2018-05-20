<?php

class PiscoController extends Controller
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

    protected function beforeAction($action)
    {
        if (Yii::app()->myClass->isClient()) {
            $id = Yii::app()->getRequest()->getQuery('id');
            //Seguridad con los registros a travez del ID
            if ($id) {
                $pisco = $this->loadModel($id);
                if ($pisco->userId != Yii::app()->user->id) {
                    $this->redirect(array('site/'));
                }
            }
        }
        return parent::beforeAction($action);
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
				'actions'=>array('index','delete','create','update','view','pictures','deletePicture','cupones','deleteCuponDescuento','updateCuponDescuento','horarios','updateHorario'),
				'users'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','pictures','view','deletePicture','cupones','deleteCuponDescuento','updateCuponDescuento','horarios','updateHorario'),
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
		$model=new Pisco;

        //Si es diferente de admin setear el usuario
        if (!Yii::app()->myClass->isAdmin()) {
            $model->userId = Yii::app()->user->id;
            $model->activo = 0;
            $model->esDestacado = 0;
        }
        // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pisco']))
		{
			$model->attributes=$_POST['Pisco'];
			if($model->save()){
                //Crear los horarios
                foreach(Horarios::dias() as $value){
                    $horario = new Horarios;
                    $horario->dia = $value;
                    $horario->horaInicial = "0:00";
                    $horario->horaFinal = "0:00";
                    $horario->piscoId = $model->id;
                    $horario->save();

                }
				$this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pisco']))
		{
			$model->attributes=$_POST['Pisco'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
        $this->loadModel($id)->delete();

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
        $criteria->join='LEFT JOIN user ON user.id=t.userId';
        if(Yii::app()->myClass->isClient()){
            $criteria->addCondition('t.userId=' . Yii::app()->user->id);
            $criteria->addCondition('t.activo=1');
            $criteria->addCondition('t.aprobado=1');
        }

        // bro-tip: $_REQUEST is like $_GET and $_POST combined
        if (isset($_REQUEST['sSearch']) && isset($_REQUEST['sSearch']{0})) {
            // use operator ILIKE if using PostgreSQL to get case insensitive search
            /*$criteria->addSearchCondition('code', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('name', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('status', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('category', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('type', $_REQUEST['sSearch'], true, 'OR', 'LIKE');*/

            $criteria->addSearchCondition('user.username', $_REQUEST['sSearch'], true, 'OR', 'LIKE');

            Yii::app()->session['piscoSearch'] = $_REQUEST['sSearch'];
        }

//        $criteria->order = 'id DESC';

        $columns = array(
            'id',
            'name',
            array(
                'name'=>'user.username',
                'type'=>'raw'
            ),
            'activo',
            'esDestacado',
            'aprobado');

        $sort = new EDTSort('Pisco', $columns);
        $sort->defaultOrder = 'id DESC';

        $pagination = new EDTPagination();
//        $pagination->setPageSize(10);

        $dataProvider = new CActiveDataProvider('Pisco', array(
            'criteria' => $criteria,
            'pagination' => $pagination,
            'sort' => $sort,
        ));

        $columns[] = array(
            'class' => 'EButtonColumn',
            'deleteConfirmation' => Yii::t('models', 'deleteConfirmation'),
            'buttons' => array(
                'view' => array(),
                'update' => array(),
                'delete' => array(
                    'options'=>array(
                        'style'=>'display:none;',
                    ),
                ),
            )
        );

        $widget = $this->createWidget('ext.nineinchnick.edatatables.EDataTables', array(
            'id' => 'pisco',
            'htmlOptions' => array('class' => 'table-responsive'),
            'itemsCssClass' => 'table table-striped table-bordered table-condensed items',
            'pagerCssClass' => 'dataTables_paginate paging_full_numbers',
            'dataProvider' => $dataProvider,
            'ajaxUrl' => $this->createUrl('/pisco/index?a'),
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


    public function actionPictures($id)
    {
        $foto = new Foto;
        $piscos = $this->loadModel($id);

        if (isset($_POST['Foto'])) {

            $foto->attributes = $_POST['Foto'];
            $foto->url = CUploadedFile::getInstance($foto, 'url');
            $foto->piscoId = $id;
            if ($foto->validate()) {

                if($foto->esPrincipal){
                   $this->refreshFotoPrincipal($piscos);
                }

                $imageWidthRequired = Yii::app()->params['fotoPiscoDimensions']['width'];
                $imageHeightRequired = Yii::app()->params['fotoPiscoDimensions']['height'];
                $imageInfo = getimagesize($foto->url->getTempName());
                $imageWidth = $imageInfo[0];
                $imageHeight = $imageInfo[1];

                //if ($imageWidth == $imageWidthRequired AND $imageHeight == $imageHeightRequired) { //TODO definir el tamaño
                    $rnd = $this->generateRandomNumber(); // generate random number between 0-9999
                    $fileName = "{$rnd}_{$foto->url->name}"; // random number + file name
                    if ($foto->save() AND !$foto->getErrors()) {
                        $foto->url->saveAs($this->getPatchPiscos() . $fileName);
                        $foto->url = $fileName;
                        $foto->save();
                        $this->redirect(array('pictures','id'=>$foto->piscoId));
                    }
                /*} else {
                    $foto->addError('url', "La imagen debe tener un ancho de $imageWidthRequired y un alto de $imageHeightRequired");
                }*/
            }
        }
        $this->render('pictures', array(
            'model' => $piscos,
            'foto' => $foto
        ));
    }

    public function actionHorarios($id){

        $criteria = new CDbCriteria;
        $criteria->addCondition('t.piscoId='.$id);
        // bro-tip: $_REQUEST is like $_GET and $_POST combined
        if (isset($_REQUEST['sSearch']) && isset($_REQUEST['sSearch']{0})) {
            $criteria->addSearchCondition('dia', $_REQUEST['sSearch'], true);

            Yii::app()->session['horarioSearch'] = $_REQUEST['sSearch'];
        }

//        $criteria->order = 'id DESC';

        $columns = array(
            'dia',
            'horaInicial',
            'horaFinal',
        );

        $sort = new EDTSort('Horarios', $columns);
        $sort->defaultOrder = 'id';

        $pagination = new EDTPagination();
//        $pagination->setPageSize(10);

        $dataProvider = new CActiveDataProvider('Horarios', array(
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
                )),
                'update' => array(
                    'url' => function ($data) {
                            return Yii::app()->controller->createUrl('updateHorario', array('id' => $data->id));
                        },
                ),
                'delete' => array('options' => array(
                    'style' => 'display:none;',
                ),)
            )
        );

        $widget = $this->createWidget('ext.nineinchnick.edatatables.EDataTables', array(
            'id' => 'pisco',
            'htmlOptions' => array('class' => 'table-responsive'),
            'itemsCssClass' => 'table table-striped table-bordered table-condensed items',
            'pagerCssClass' => 'dataTables_paginate paging_full_numbers',
            'dataProvider' => $dataProvider,
            'ajaxUrl' => $this->createUrl('/pisco/horarios?a&id=' . $id),
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
            $this->render('horarios', array('widget' => $widget,));
            return;
        } else {
            echo json_encode($widget->getFormattedData(intval($_REQUEST['sEcho'])));
            Yii::app()->end();
        }
    }

    public function  actionUpdateHorario($id){

        $model=Horarios::model()->findByPk($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Horarios']))
        {
            $model->attributes=$_POST['Horarios'];
            if($model->save())
                $this->redirect(array('horarios','id'=>$model->piscoId));
        }

        $this->render('updateHorario',array(
            'model'=>$model,
        ));

    }

    public function refreshFotoPrincipal($pisco){
        foreach ($pisco->fotoses as $foto) {
            $foto->esPrincipal = 0;
            $foto->save();

      }
    }

    public function actionDeleteCuponDescuento($id)
    {
        $model=CuponesDescuento::model()->findByPk($id);
        $piscoId = $model->piscoId;
        $oldImageName = $model->imageUrl;
        $model->delete();
        //Eliminar imagenes anterior
        unlink($this->getPatchCupones().$oldImageName);

        if (!Yii::app()->getRequest()->getIsAjaxRequest())
            $this->redirect(isset($_POST['returnUrl']) ?
                $_POST['returnUrl'] :
                array('cupones','id'=>$piscoId));

        else echo "{}";
    }

    public function actionCupones($id){
        $model = new CuponesDescuento;
        $model->setScenario('Create');

        if (isset($_POST['CuponesDescuento'])) {
            $model->attributes = $_POST['CuponesDescuento'];
            $model->imageUrl = CUploadedFile::getInstance($model, 'imageUrl');
            $model->piscoId = $id;
            if ($model->validate()) {

                $imageWidthRequired = Yii::app()->params['fotoPiscoDimensions']['width'];
                $imageHeightRequired = Yii::app()->params['fotoPiscoDimensions']['height'];
                $imageInfo = getimagesize($model->imageUrl->getTempName());
                $imageWidth = $imageInfo[0];
                $imageHeight = $imageInfo[1];

                //if ($imageWidth == $imageWidthRequired AND $imageHeight == $imageHeightRequired) { //TODO definir el tamaño
                $rnd = $this->generateRandomNumber(); // generate random number between 0-9999
                $fileName = "{$rnd}_{$model->imageUrl->name}"; // random number + file name
                if ($model->save() AND !$model->getErrors()) {
                    $model->imageUrl->saveAs($this->getPatchCupones() . $fileName);
                    $model->imageUrl = $fileName;
                    $model->save();
                    $this->redirect(array('cupones','id'=>$model->piscoId));
                }
                /*} else {
                    $foto->addError('url', "La imagen debe tener un ancho de $imageWidthRequired y un alto de $imageHeightRequired");
                }*/
            }
        }

        $criteria = new CDbCriteria;
        // bro-tip: $_REQUEST is like $_GET and $_POST combined
        if (isset($_REQUEST['sSearch']) && isset($_REQUEST['sSearch']{0})) {
            // use operator ILIKE if using PostgreSQL to get case insensitive search
            $criteria->addSearchCondition('name', $_REQUEST['sSearch'], true, 'OR', 'LIKE');

            Yii::app()->session['cuponesDescuentoSearch'] = $_REQUEST['sSearch'];
        }

//        $criteria->order = 'id DESC';

        $columns = array(
            'name',
            array(
                'name' => 'imageUrl',
               // 'header' => 'imageUrl',
                'sortable' => true,
                'type' => 'raw',
                'value' => 'CHtml::image(Yii::app()->baseUrl . "/images/cupones/" . $data->imageUrl, "imagen", array("width" => 260, "height" => 180))',

            ),);

        $sort = new EDTSort('CuponesDescuento', $columns);
        $sort->defaultOrder = 'id DESC';

        $pagination = new EDTPagination();
//        $pagination->setPageSize(10);

        $dataProvider = new CActiveDataProvider('CuponesDescuento', array(
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
                )),
                'update' => array(
                    'url' => function($data) {
                            return Yii::app()->controller->createUrl('updateCuponDescuento', array('id' => $data->id));
                        }
                ),
                'delete' => array(
                    'url' => function($data) {
                            return Yii::app()->controller->createUrl('deleteCuponDescuento', array('id' => $data->id));
                        }
                )
            )
        );

        $widget = $this->createWidget('ext.nineinchnick.edatatables.EDataTables', array(
            'id' => 'cupone_descuento',
            'htmlOptions' => array('class' => 'table-responsive'),
            'itemsCssClass' => 'table table-striped table-bordered table-condensed items',
            'pagerCssClass' => 'dataTables_paginate paging_full_numbers',
            'dataProvider' => $dataProvider,
            'ajaxUrl' => $this->createUrl('/pisco/cupones?a&id=' . $id),
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
            $this->render('cupones', array(
                'model' => $model,
                'widget' => $widget
            ));
            return;
        } else {
            echo json_encode($widget->getFormattedData(intval($_REQUEST['sEcho'])));
            Yii::app()->end();
        }


    }

    public function actionUpdateCuponDescuento($id){

        $model=CuponesDescuento::model()->findByPk($id);
        $model->setScenario('Update');
        $oldImageName = $model->imageUrl;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['CuponesDescuento']))
        {
            /*$model->attributes=$_POST['CuponesDescuento'];
            if($model->save())
                $this->redirect(array('cupones','id'=>$model->id));*/
            $model->attributes=$_POST['CuponesDescuento'];
            $model->imageUrl = CUploadedFile::getInstance($model, 'imageUrl');
            if ($model->validate()) {
                $isValidateImage = empty($model->image);

                $imageWidthRequired = Yii::app()->params['fotoCuponDescuentoDimensions']['width'];
                $imageHeightRequired = Yii::app()->params['fotoCuponDescuentoDimensions']['height'];
                if(!$isValidateImage){
                    $imageInfo = getimagesize($model->image->getTempName());
                    $imageWidth = $imageInfo[0];
                    $imageHeight = $imageInfo[1];
                    //$isValidateImage = $imageWidth == $imageWidthRequired AND $imageHeight == $imageHeightRequired; TODO falta validar la imagen
                    $isValidateImage = true;
                }

                if ($isValidateImage) {
                    if ($model->imageUrl) {
                        $rnd = $this->generateRandomNumber();
                        $fileName = "{$rnd}_{$model->imageUrl->name}"; // random number + file name
                        $model->imageUrl->saveAs($this->getPatchCupones() . $fileName);
                        $model->imageUrl = $fileName;
                        $model->save();
                        //Eliminar imagen anterior
                        unlink($this->getPatchCupones() . $oldImageName);
                    } else {
                        $model->imageUrl = $oldImageName;
                        $model->save();
                    }
                    $this->redirect(array('cupones', 'id' => $model->pisco->id));
                } else {
                    $model->addError('image', "The image must have a width of $imageWidthRequired and a height of $imageHeightRequired");
                }
            }
        }

        $this->render('updateCuponDescuento',array(
            'model'=>$model,
        ));

    }

    public function actionDeletePicture($id)
    {
        $model=Foto::model()->findByPk($id);
        $piscoId = $model->piscoId;
        $oldImageName = $model->url;
        $model->delete();
        //Eliminar imagenes anterior
        unlink($this->getPatchPiscos().$oldImageName);

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('pictures','id'=>$piscoId));
    }

    private function generateRandomNumber()
    {
        return rand(0,9999);
    }

    private function getPatchPiscos()
    {
        return Yii::app()->basePath . '/../images/piscos/';
    }

    private function getPatchCupones()
    {
        return Yii::app()->basePath . '/../images/cupones/';
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pisco the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pisco::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pisco $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pisco-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
