<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	'Noticias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Noticias', 'url'=>array('index')),
	//array('label'=>'Create Noticia', 'url'=>array('create')),
	array('label'=>'Editar Noticia', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Noticia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Noticia', 'url'=>array('admin')),
);
?>

<h1>Noticia </h1>

<div class="row">
    <div class="col-sm-7">
        <section class="panel panel-default">
            <div class="panel-body">
                <?php $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'attributes' => array(
                        'id',
                        'titulo',
                        'text',
                        'creado',
                        array(
                            'label' => 'Categoria',
                            'type' => 'raw',
                            'value' => $model->categoria->nombre,
                        ),
                        array(
                            'label' => 'Imagen',
                            'type' => 'raw',
                            'value' => CHtml::image(Yii::app()->baseUrl . '/images/noticias/' . $model->imageUrl),
                        ),
                    ),
                    'htmlOptions' => array('class' => 'table table-striped m-b-none', 'width' => '100px')
                ));
                ?>
            </div>
        </section>
    </div>
</div>
