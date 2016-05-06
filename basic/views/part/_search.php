<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PartSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="part-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'part_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'part_number') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'manufacturer_fk') ?>

    <?php // echo $form->field($model, 'role_fk') ?>

    <?php // echo $form->field($model, 'overal_rating') ?>

    <?php // echo $form->field($model, 'more_info') ?>

    <?php // echo $form->field($model, 'price') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
