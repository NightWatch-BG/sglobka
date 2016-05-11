<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Part */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'part_number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'manufacturer_fk')->dropDownList($manufacturers, ['prompt' => '--- Select manufacturer ---']) ?>

<?= $form->field($model, 'more_info')->textarea(['maxlength' => true, 'rows' => 2]) ?>

<?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

