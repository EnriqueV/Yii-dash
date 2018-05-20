<?php foreach (Yii::app()->user->getFlashes() as $key => $message) { ?>
    <?php if ($key == 'error'): ?>
        <div class="alert alert-danger">
            <button data-dismiss="alert" class="close" type="button">×</button>
            <i class="fa fa-ban-circle"></i><strong>Error!</strong>
            <?php echo $message ?>
        </div>
    <?php endif; ?>
    <?php if ($key == 'success'): ?>
        <div class="alert alert-success">
            <button data-dismiss="alert" class="close" type="button">×</button>
            <i class="fa fa-ban-circle"></i><strong>Exito!</strong>
            <?php echo $message ?>

        </div>
    <?php endif; ?>
    <?php if ($key == 'notice'): ?>
        <div class="alert alert-info">
            <button data-dismiss="alert" class="close" type="button">×</button>
            <i class="fa fa-ban-circle"></i><strong>Exito!</strong>
            <?php echo $message ?>
        </div>
    <?php endif; ?>
<?php } ?>