<div class="form">

<?php /*$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Campos com  (<span class="required">*</span>) são obrigatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idioma'); ?>
		<?php echo $form->textField($model,'idioma'); ?>
		<?php echo $form->error($model,'idioma'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar Alterações'); ?>
	</div>

<?php $this->endWidget(); */?>

</div><!-- form -->
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
)); ?>

<!--<form id="user-form" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=user/create" method="post">
-->    <fieldset>
        <legend>Informações</legend>

        <h2>Inputs &amp; Datepicker</h2>
        <p>
            <?php echo $form->labelEx($model,'login'); ?>
            <input class="sf" name="User[login]" type="text" value="" />
        </p>

        <p>
            <?php echo $form->labelEx($model,'name'); ?>
            <input class="sf" name="User[name]" type="text" value="" />
        </p>

        <p>
            <?php echo $form->labelEx($model,'pass'); ?>
            <input class="sf" name="User[pass]" type="password" value="" />
        </p>

        <p class="controlForm">
            <input class="button" type="submit" value="Salvar" /> <input class="button" type="reset" value="Resetar" />
        </p>
    </fieldset>
<?php $this->endWidget(); ?>
<!--</form>
-->