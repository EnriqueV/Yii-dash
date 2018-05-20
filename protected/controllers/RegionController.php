<?php

class RegionController extends Controller
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
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete','index','view','create','update'),
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
		$model=new Region;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Region']))
		{
			$model->attributes=$_POST['Region'];
			if($model->save())
				$this->redirect(array('index'));
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

		if(isset($_POST['Region']))
		{
			$model->attributes=$_POST['Region'];
			if($model->save())
				$this->redirect(array('index'));
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
        try {
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));

            else echo "{}";
        } catch (Exception $e) {
            //echo "{'error':'No se puede eliminar la region ya que se encuentra asignada a uno o mas piscos.'}";
            //echo "<script>alert('No se puede eliminar la region ya que se encuentra asignada a uno o mas piscos.');</script>";
            if(!Yii::app()->getRequest()->getIsAjaxRequest()){
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index',"msj"=>'No se puede eliminar la region ya que se encuentra asignada a uno o mas piscos.'));
                //$this->actionIndex();
            }

            //echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($msj = NULL)
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

            Yii::app()->session['regionSearch'] = $_REQUEST['sSearch'];
        }

//        $criteria->order = 'id DESC';

        $columns = array(
            'nombre');

        $sort = new EDTSort('Region', $columns);
        $sort->defaultOrder = 'id DESC';

        $pagination = new EDTPagination();
//        $pagination->setPageSize(10);

        $dataProvider = new CActiveDataProvider('Region', array(
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
                'delete' => array(
                    'click'=>"", // No eliminar esto ya que permite remover un item sin ajax
                    //'url' => 'array("delete?id=".$data->id)'
                    //'htmlOptions'=> array('onclick' => 'alert("TESTE");')

                )
            )
        );

        $widget = $this->createWidget('ext.nineinchnick.edatatables.EDataTables', array(
            'id' => 'region',
            'htmlOptions' => array('class' => 'table-responsive'),
            'itemsCssClass' => 'table table-striped table-bordered table-condensed items',
            'pagerCssClass' => 'dataTables_paginate paging_full_numbers',
            'dataProvider' => $dataProvider,
            'ajaxUrl' => $this->createUrl('/region/index?a'),
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
            $this->render('index', array('widget' => $widget,'msj' => $msj));
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
		$model=new Region('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Region']))
			$model->attributes=$_GET['Region'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Region the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Region::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Region $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='region-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
