<?php
/* @var $this HorariosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Horarioses',
);

$this->menu=array(
	array('label'=>'<i class="fa fa-plus"></i> Create Horarios', 'url'=>array('create')),
	array('label'=>'Manage Horarios', 'url'=>array('admin')),
);
?>

<h3>Horarioses</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
