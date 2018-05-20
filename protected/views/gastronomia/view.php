<?php
/* @var $this GastronomiaController */
/* @var $model Gastronomia */

$this->breadcrumbs=array(
	'Gastronomias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Lista Gastronomia', 'url'=>array('index')),
	array('label'=>'Editar Gastronomia', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Eliminar Gastronomia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
<div class="row">
    <div class="col-sm-8">
        <section class="panel panel-default">
            <div class="panel-body">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'label' => 'Pisco',
            'type' => 'raw',
            'value' => $model->pisco->name,
        ),
		'titulo',
		'descripcion',
        array(
            'label' => 'Imagen',
            'type' => 'raw',
            'value' => CHtml::image(Yii::app()->baseUrl . '/images/gastronomia/' . $model->imageUrl),
        ),
	),
    'htmlOptions' => array('class' => 'table table-striped m-b-none', 'width' => '100px')
)); ?>
            </div>
        </section>
    </div>
</div>
