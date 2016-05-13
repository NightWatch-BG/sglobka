<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BuildPart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="build-part-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'build_guide_fk')->textInput() ?>

    <?= $form->field($model, 'part_fk')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
