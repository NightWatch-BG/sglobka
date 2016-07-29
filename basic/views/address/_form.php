<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true,  'type' => 'tel']) ?>

    <?= $form->field($model, 'country_fk')->dropDownList($countries, [
	'prompt' => '--- Select country ---',
	'onchange' => '
	$.post("lists/'.'"+$(this).val(), function (data){
	    $( "select#address-city_fk" ).html(data);
	});'
	
	]) ?>

    <?= $form->field($model, 'city_fk')->dropDownList($cities, ['prompt' => '--- Select city ---']) ?>
    
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
