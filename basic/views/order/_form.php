<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_fk')->textInput() ?>

    <?= $form->field($model, 'staff_fk')->textInput() ?>

    <?= $form->field($model, 'build_fk')->textInput() ?>

    <?= $form->field($model, 'status_fk')->textInput() ?>

    <?= $form->field($model, 'notes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_of_order')->textInput() ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
