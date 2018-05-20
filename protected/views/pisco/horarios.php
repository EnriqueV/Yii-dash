<?php
/**
 * Created by PhpStorm.
 * User: PERSONAL
 * Date: 27/10/17
 * Time: 2:26
 */

$this->menu=array(
    //array('label'=>'List Horarios', 'url'=>array('index')),
    //array('label'=>'Create Horarios', 'url'=>array('create')),
    array('label'=>'Regresar', 'url'=>array('pisco/view', 'id'=>$_GET["id"])),
    //array('label'=>'Manage Horarios', 'url'=>array('admin')),
);
?>
<div class="panel panel-default">
    <?php $widget->run(); ?>
</div>