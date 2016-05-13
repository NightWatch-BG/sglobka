<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BuildGuideSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="build-guide-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'build_guide_id') ?>

    <?= $form->field($model, 'user_fk') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'guide') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
