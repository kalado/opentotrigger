<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>true,
)); ?>
<script type="text/javascript">
</script>
<!--<form id="user-form" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=user/create" method="post">
-->    <fieldset>
        <legend>Informações</legend>

        <h2>Inputs &amp; Datepicker</h2>
        <p>
            <?php echo $form->labelEx($model,'nome'); ?>
            <?php echo $form->textField($model,"nome", array("class"=>"sf")); ?>
            <?php echo $form->error($model,'nome'); ?>
        </p>

        <p>
            <?php echo $form->labelEx($model,'login'); ?>
            <?php echo $form->textField($model,"login", array("class"=>"sf")); ?>
            <?php echo $form->error($model,'login'); ?>
        </p>

        <p>
            <?php echo $form->labelEx($model,'senha'); ?>
            <?php echo $form->passwordField($model,"senha", array("class"=>"sf")); ?>
            <?php echo $form->error($model,'senha'); ?>
        </p>
        
        <p>
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,"email", array("class"=>"sf")); ?>
            <?php echo $form->error($model,'email'); ?>
        </p>

        <p class="controlForm">
            <input class="button" type="submit" value="Salvar" /> <input class="button" type="reset" value="Resetar" />
        </p>
    </fieldset>
<?php $this->endWidget(); ?>

</div>
