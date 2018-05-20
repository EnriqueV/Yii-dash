<div class="panel-body">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'afterValidate' => 'js:function(form, data, hasError) {
            if(hasError) {
              for(var i in data) $("#"+i).addClass("parsley-error");
              return false;
            }
            else {
              form.children().removeClass("parsley-error");
              return true;
            }
        }',
            'afterValidateAttribute' => 'js:function(form, attribute, data, hasError) {
            if(hasError) $("#"+attribute.id).addClass("parsley-error");
            else $("#"+attribute.id).removeClass("parsley-error");
        }'
        ),
        'htmlOptions' => array(
            'class' => '',
        ),
    ));

    ?>

    <?php
    if ($model->getErrors() || $profile->getErrors()) {
        ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-ban-circle"></i>
            <?php echo $form->errorSummary(array($model, $profile)); ?>
        </div>
    <?php }  ?>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 128,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="form-group">
        <?php //echo $form->labelEx($model, 'superuser'); ?>
        <?php //echo $form->dropDownList($model, 'superuser', User::itemAlias('AdminStatus'),array('class' => 'form-control')); ?>
        <?php //echo $form->error($model, 'superuser'); ?>
    </div>

    <?php
    if (Yii::app()->myClass->isAdmin()) {  ?>

    <?php } ?>

    <div class="form-group">
        <label for="User_status" class="required">Rol <span class="required">*</span></label>
        <select class="form-control" name="User[rol]">
            <?php foreach(AuthItem::model()->findAll(array("condition"=>"type =  2")) as $item){ ?>
                <option><?php echo $item->name ?></option>
            <?php } ?>
        </select>
        <?php //echo $form->dropDownList($modelAuthItem, 'type', AuthItem::model()->findAll(),array('class' => 'form-control')); ?>
        <?php //echo $form->error($modelAuthItem, 'name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', User::itemAlias('UserStatus'),array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>
    <?php
    $profileFields = Profile::getFields();
    if ($profileFields) {
        foreach ($profileFields as $field) {
            ?>
            <div class="form-group">
                <?php echo $form->labelEx($profile, $field->varname); ?>
                <?php
                if ($widgetEdit = $field->widgetEdit($profile)) {
                    echo $widgetEdit;
                } elseif ($field->range) {
                    echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
                } elseif ($field->field_type == "TEXT") {
                    echo CHtml::activeTextArea($profile, $field->varname, array('rows' => 6, 'cols' => 50,'class' => 'form-control'));
                } else {
                    echo $form->textField($profile, $field->varname, array('size' => 60,'class' => 'form-control', 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                }
                ?>
                <?php echo $form->error($profile, $field->varname); ?>
            </div>
        <?php
        }
    }
    ?>
    <footer class="panel-footer bg-light lter">
        <a href="javascript:history.go(-1)" class="btn btn-default btn-s-xs">Cancelar</a>
        <?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'),array('class' => 'btn btn-primary btn-s-xs')); ?>
    </footer>

    <?php $this->endWidget(); ?>

</div><!-- panel-body -->