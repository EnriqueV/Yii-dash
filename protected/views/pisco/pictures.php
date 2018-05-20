<?php
/* @var $model Pisco */
/* @var $foto Foto */

$this->menu=array(
    array('label'=>'Piscos', 'url'=>array('index')),
    //array('label'=>'Agregar Imagen', 'url'=>array('pictures')),
);

$fotos = $model->fotoses;
?>
<br>

<?php
if(sizeof($fotos) < 3){
?>
<div class="panel-body">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'foto-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    )); ?>
    <?php if($form->errorSummary($foto)){ ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="fa fa-ban-circle"></i><strong>Oh snap!</strong>
            <?php echo $form->errorSummary($foto); ?>
        </div>
    <?php } ?>
    <div class="form-group">
        <?php echo $form->labelEx($foto,'url'); ?>
        <?php echo $form->fileField($foto, 'url', array('class' => 'form-control', 'maxlength' => 75)); ?>
        <?php echo $form->error($foto,'url'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($foto, 'esPrincipal'); ?>
        <?php echo $form->checkBox($foto, 'esPrincipal', array('class' => 'span5', 'maxlength' => 45)); ?>
        <?php echo $form->error($foto,'esPrincipal'); ?>
    </div>

    <footer class="panel-footer bg-light lter">
        <?php echo CHtml::submitButton($foto->isNewRecord ? 'Crear' : 'Guardar',array('class' => 'btn btn-primary btn-s-xs')); ?>
    </footer>

    <?php $this->endWidget(); ?>

</div>
<?php
    }
?>
<br>
<div class="row">
    <div class="col-sm-8">
        <section class="panel panel-default">
            <header class="panel-heading">
                <span class="label bg-danger pull-right m-t-xs">3 max</span>
                Imagenes
            </header>
            <table class="table table-striped m-b-none">
                <tbody>
                <?php

                foreach ($model->fotoses as $foto) {

                    ?>
                    <tr>
                        <td>
                            <?php echo CHtml::image(Yii::app()->baseUrl . '/images/piscos/' . $foto->url, 'imagen', array('width' => 260, 'height' => 180)) ?>
                        </td>
                        <td class="text-right">
                            <div class="btn-group">
                                <?php echo CHtml::link('<i class="fa fa-trash-o"></i>',array('pisco/deletePicture','id'=>$foto->id)); ?>
                            </div>
                        </td>
                    </tr>
                <?php

                }

                ?>
                </tbody>
            </table>
        </section>
    </div>
</div>