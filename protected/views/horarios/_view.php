<?php
/* @var $this HorariosController */
/* @var $data Horarios */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dia')); ?>:</b>
	<?php echo CHtml::encode($data->dia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horaInicial')); ?>:</b>
	<?php echo CHtml::encode($data->horaInicial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horaFinal')); ?>:</b>
	<?php echo CHtml::encode($data->horaFinal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('piscoId')); ?>:</b>
	<?php echo CHtml::encode($data->piscoId); ?>
	<br />


</div>