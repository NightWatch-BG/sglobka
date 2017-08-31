<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GuideReview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guide-review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'review')->textArea(['maxlength' => true, 'rows' => 4]) ?>

    <?= $form->field($model, 'rating')->radioList(array ('1' => '1*', '2' => '2*', '3' => '3*',  '4' => '4*', '5' => '5*')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
