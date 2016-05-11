<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Part */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'parameter_ids[psuType_id]')->radioList($parametersData['psuType'])->label('Type') ?>

<?= $form->field($model, 'parameter_ids[psuModular]')->radioList($parametersData['psuModular'])->label('Modular') ?>

<?= $form->field($model, 'parameter_ids[psuEfficiency_id]')->radioList($parametersData['psuEfficiency'])->label('Efficiency') ?>

<?= $form->field($model, 'parameter_ids[psuWatts_id]')->radioList($parametersData['psuWatts'])->label('Watts') ?>

