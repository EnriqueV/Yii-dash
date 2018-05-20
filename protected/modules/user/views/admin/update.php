<?php
$this->breadcrumbs=array(
	(UserModule::t('Users'))=>array('admin'),
	$model->username=>array('view','id'=>$model->id),
	(UserModule::t('Update')),
);

?>

<div class="panel panel-default">
    <div class="panel-body">
        <h3 class="m0">Actualizar Usuario <?php echo $model->id; ?></h3>
    </div>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>
</div>