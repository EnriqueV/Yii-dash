<!--<div class="section" id="section7">
    <div class="wrap">
        <div class="box">

            <h2><strong>Registratea</strong></h2>


            <form role="form" method="post" id="contact-form">
                <input type="text" placeholder="Nombre" name="Name" id="Name" required>
                <input type="email" placeholder="Email" name="Email" id="Email" required>
                <input type="text" placeholder="Telefono" name="Phone" id="Phone">
                <input type="text" placeholder="Asunto" name="Subject" id="Subject">
                <textarea placeholder="Mensaje" name="Message" id="Message" required></textarea>
                <button type="submit" id="submit">Enviar</button>
                <div id="success"></div>
            </form>

        </div>
    </div>
</div>-->

<div class="section" id="section5">
    <div class="wrap">
        <div class="box">
            <h2><strong>Regístrate</strong></h2>
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'contact-form',
                'action'=>Yii::app()->createUrl('#Register'),
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
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fa fa-ban-circle"></i>
                    <?php echo $form->errorSummary(array($model, $profile)); ?>
                </div>
            <?php }  ?>

                <?php //echo $form->labelEx($model, 'username'); ?>
                <?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20,'placeholder' => 'Usuario')); ?>
                <?php //echo $form->error($model, 'username'); ?>
                <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 128,'placeholder' => 'Clave')); ?>
                <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128,'placeholder' => 'Correo electrónico')); ?>
                <?php
                $profileFields = Profile::getFields();
                if ($profileFields) {
                    foreach ($profileFields as $field) {
                        ?>
                        <div class="form-group">
                            <?php //echo $form->labelEx($profile, $field->varname); ?>
                            <?php
                            if ($widgetEdit = $field->widgetEdit($profile)) {
                                echo $widgetEdit;
                            } elseif ($field->range) {
                                echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
                            } elseif ($field->field_type == "TEXT") {
                                echo CHtml::activeTextArea($profile, $field->varname, array('rows' => 6, 'cols' => 50,'class' => 'form-control'));
                            } else {
                                echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255),'placeholder' => Yii::t('models', $field->varname)));
                            }
                            ?>
                            <?php //echo $form->error($profile, $field->varname); ?>
                        </div>
                    <?php
                    }
                }
                ?>
                 <br><br><br><br><br><br><br>
                 <button type="submit" id="submit">Enviar</button>
                <div id="success">
                    <?php
                    if($registroExitoso){
                    ?>
                        <div class='alert-success'>Te has registrado de exitosamente!</div>
                    <?php } ?>
                </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>