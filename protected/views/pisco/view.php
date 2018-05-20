<?php
/* @var $this PiscoController */
/* @var $model Pisco */

$this->breadcrumbs=array(
	'Piscos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Piscos', 'url'=>array('index')),
	array('label'=>'Cupones', 'url'=>array('cupones','id'=>$model->id)),
	array('label'=>'Imagenes Slider', 'url'=>array('pictures','id'=>$model->id)),
	array('label'=>'Horarios', 'url'=>array('horarios','id'=>$model->id)),
	array('label'=>'Editar Pisco', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Eliminar Pisco', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('models', 'deleteConfirmation'))),
	//array('label'=>'Manage Pisco', 'url'=>array('admin')),
);
?>


<section class="panel panel-info">
    <div class="panel-heading" style="color: #3C4144;">
        <?php echo $model->name;
        ?>
    </div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'latitud',
		'longitud',
		'telefono',
		'direccion',
		'web',
		'activo',
		'userId',
		'ratingGeneral',
		'youtubeUrl',
		'esDestacado',
		'aprobado',
        array(
            'label' => $model->getAttributeLabel('regionId'),
            'type' => 'raw',
            'value' => $model->region->nombre
        )
	),
    'itemTemplate' => '<tr class=\"{class}\"><th width="175px">{label}</th><td>{value}</td></tr>',
    'htmlOptions' => array('class' => 'table table-striped m-b-none', 'width' => '100px')
)); ?>
</section>
