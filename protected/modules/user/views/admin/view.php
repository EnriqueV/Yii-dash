<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('admin'),
	$model->username,
);


$this->menu=array(
    array('label' => '<i class="fa fa-chevron-left"></i>   Regresar', 'icon' => 'fa fa-chevron-left', 'url' => array('#'), 'htmlOptions' => array('onclick' => 'history.go(-1);'),),
    array('label'=>'<i class="fa  fa-plus"></i> '.UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>'<i class="fa  fa-refresh"></i> '.UserModule::t('Update User'), 'url'=>array('update','id'=>$model->id)),
    array('label'=>'<i class="fa  fa-trash-o"></i> '.UserModule::t('Delete User'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
/*    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),*/
);
?>
<!--<h4><?php /*echo UserModule::t('View User').' "'.$model->username.'"'; */?></h4>-->

<?php
 
	$attributes = array(
		'id',
		'username',
	);
	
	$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'type'=>'raw',
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),
				));
		}
	}
	
	array_push($attributes,
		//'password',
		'email',
		//'activkey',
		'create_at',
		'lastvisit_at',
		array(
			'name' => 'superuser',
			'value' => User::itemAlias("AdminStatus",$model->superuser),
		),
		array(
			'name' => 'status',
			'value' => User::itemAlias("UserStatus",$model->status),
		)
	);
	
	/*$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));*/
?>

<section class="panel panel-info">
    <div class="panel-heading" style="color: #3C4144;">
        <?php echo $model->username; ?>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => $attributes,
    'htmlOptions' => array('class' => 'table table-striped m-b-none', 'width' => '100px')
)); ?>
</section>

