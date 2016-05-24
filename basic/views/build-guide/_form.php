<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BuildGuide */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="build-guide-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'guide')->textarea(['maxlength' => true, 'rows' => 4]) ?>
    
    <p><?= "Visibility settings:
    <br>Public - the guide can be seen by all users
    <br>Private - the guide can be viewed only by the author." ?></p>

    <?= $form->field($model, 'visibility_fk')->dropDownList($visibility) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
