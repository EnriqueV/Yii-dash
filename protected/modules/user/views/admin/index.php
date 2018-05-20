<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('/user'),
	UserModule::t('Manage'),
);

$this->menu=array(
    array('label'=>'<i class="fa fa-plus"></i> '.UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>'<i class="fa fa-cloud-download"></i> Exportar', 'url'=>array('export')),
   // array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
   // array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
   // array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);
?>
<!--<h4><?php /*echo UserModule::t("Manage Users"); */?></h4>-->
<h3>Administración de usuarios</h3>
<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>
