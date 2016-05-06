<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Part */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="part-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'part_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacturer_fk')->dropDownList($manufacturers, ['prompt' => '--- Select manufacturer ---']) ?>
    <?php if(count($roles) > 1): ?>
	<?= $form->field($model, 'role_fk')->dropDownList($roles, ['prompt' => '--- Select Role ---']) ?>
    <?php else: ?>
	<?= $form->field($model, 'role_fk')->dropDownList($roles) ?>
    <?php  endif; ?>
    
    <?= $form->field($model, 'more_info')->textarea(['maxlength' => true, 'rows' => 2]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
