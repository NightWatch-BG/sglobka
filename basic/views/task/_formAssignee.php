<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => 4, 'disabled' => true]) ?>

    <?= $form->field($model, 'status_fk')->dropDownList($status, ['options' => [1 => ['disabled' => true]]]) ?>
    
    <?= $form->field($model, 'due_date')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'assigned_to')->dropDownList($assignees, ['prompt' => '--- Assign to ---', 'disabled' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
