<?php

class AdminController extends Controller
{
	public $defaultAction = 'admin';
	//public $layout='//layouts/column2';
    public $layout = '//layouts/fixed';

	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
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
				'actions'=>array('admin','delete','create','update','view','export'),
				'users'=>UserModule::getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


    public function actionExport()
    {
        Yii::import('ext.ExportXLS.ExportXLS');

        $headercolums =array('id','Usuario','telefono','email','Fecha Creado','Ultima visita','Super usuario','Estado');
        $colums =array('id','username','telefono','email','create_at','lastvisit_at','superuser','status');
        $model = User::model();
        $criteria = new CDbCriteria;
        $criteria->select = $colums;

        //if (isset(Yii::app()->session['salesmanSearch']) && isset(Yii::app()->session['salesmanSearch']{0})) {
        if (isset(Yii::app()->session['userSearch']) && isset(Yii::app()->session['userSearch']{0})) {
            // use operator ILIKE if using PostgreSQL to get case insensitive search
            $criteria->addSearchCondition('username', Yii::app()->session['userSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('email', Yii::app()->session['userSearch'], true, 'OR', 'LIKE');
            //$criteria->addSearchCondition('last_name', Yii::app()->session['salesmanSearch'], true, 'OR', 'LIKE');

            $rows = $model->getCommandBuilder()
                ->createFindCommand($model->tableSchema, $criteria)
                ->queryAll(false, array());

            unset(Yii::app()->session['userSearch']); //destruir variable
        } else {
            $rows = $model->getCommandBuilder()
                ->createFindCommand($model->tableSchema, $criteria)
                ->queryAll(false, array());
        }


        $xls = new ExportXLS('usuarios'.date("dmy").'.xls');
        $header = null;
        //$xls->addHeader($model->tableSchema->columnNames);
        $xls->addHeader($headercolums);
        $xls->addRow($rows);
        $xls->sendFile();
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		/*$model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('index',array(
            'model'=>$model,
        ));*/
        //        $dataProvider = new CActiveDataProvider('Customer');
//        $this->render('index', array(
//            'dataProvider' => $dataProvider,
//        ));

        $criteria = new CDbCriteria;
        // bro-tip: $_REQUEST is like $_GET and $_POST combined
        if (isset($_REQUEST['sSearch']) && isset($_REQUEST['sSearch']{0})) {
            // use operator ILIKE if using PostgreSQL to get case insensitive search
            $criteria->addSearchCondition('username', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            $criteria->addSearchCondition('email', $_REQUEST['sSearch'], true, 'OR', 'LIKE');
            Yii::app()->session['userSearch'] = $_REQUEST['sSearch'];
        }

//        $criteria->order = 'id DESC';

        $columns = array(
            'id',
            'username',
            'email',
            'create_at',
            'lastvisit_at',
            'superuser',
            'status'
             );

        $sort = new EDTSort('User', $columns);
        $sort->defaultOrder = 'id';

        $pagination = new EDTPagination();
//        $pagination->setPageSize(10);

        $dataProvider = new CActiveDataProvider('User', array(
            'criteria' => $criteria,
            'pagination' => $pagination,
            'sort' => $sort,
        ));
        $columns[] = array(
            'class' => 'EButtonColumn',
            'buttons' => array(
                'view' => array(),
                'update' => array(),
                'delete' => array('options' => array(
                    'style' => 'display:none;',
                ))
            )
        );

        $widget = $this->createWidget('ext.nineinchnick.edatatables.EDataTables', array(
            'id' => 'customer',
            'htmlOptions' => array('class' => 'table-responsive'),
            'itemsCssClass' => 'table table-striped table-bordered table-condensed items',
            'pagerCssClass' => 'dataTables_paginate paging_full_numbers',
            'dataProvider' => $dataProvider,
            'ajaxUrl' => $this->createUrl('/user/admin?a'),
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
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$model = $this->loadModel();
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $modelAuthItem = new AuthItem;
		$model=new User;
        $model->setScenario('Create');
		$profile=new Profile;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
            $rol = $_POST['User']["rol"];
			$model->attributes=$_POST['User'];

            if($rol == Yii::app()->params['rol_admin']){
                $model->superuser = 1;
            }else if($rol == Yii::app()->params['rol_cliente']){
                $model->superuser = 2;
            }else{
                $model->superuser = 3;
            }
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
			$profile->attributes=$_POST['Profile'];
			$profile->user_id=0;
			if($model->validate()&&$profile->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					$profile->user_id=$model->id;
					$profile->save();

                    //Agregar Rol
                    $modelAuthAssignment = new AuthAssignment;
                    $modelAuthAssignment->itemname = $rol;
                    $modelAuthAssignment->userid = $model->id;
                    $modelAuthAssignment->data = "N;";
                    $modelAuthAssignment->save();
				}
				$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		}

		$this->render('create',array(
			'model'=>$model,
			'profile'=>$profile,
			'modelAuthItem'=>$modelAuthItem
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		$profile=$model->profile;
		$this->performAjaxValidation(array($model,$profile));
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$old_password = User::model()->notsafe()->findByPk($model->id);
				if ($old_password->password!=$model->password) {
					$model->password=Yii::app()->controller->module->encrypting($model->password);
					$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
				}
				$model->save();
				$profile->save();
				$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		}

		$this->render('update',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		//if(Yii::app()->request->isPostRequest)
		//{
			// we only allow deletion via POST request
			$model = $this->loadModel();
			$profile = Profile::model()->findByPk($model->id);
			
			// Make sure profile exists
			/*if ($profile)
				$profile->delete();*/

			$model->delete();
            //$model->status = 0;
            //$model->save();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			/*if(!isset($_POST['ajax']))
				$this->redirect(array('/user/admin'));*/
            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(isset($_POST['returnUrl']) ?
                    $_POST['returnUrl'] :
                    array('admin'));

            else echo "{}";
		//}
		//else
		//	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->notsafe()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
}
