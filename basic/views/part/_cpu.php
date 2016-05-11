<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Part */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'parameter_ids[cpuSocket_id]')->dropDownList($parametersData['cpuSockets'], ['prompt' => '--- Select CPU Socket ---'])->label('CPU Socket') ?>

<?= $form->field($model, 'parameter_ids[cpuCores_id]')->radioList($parametersData['cpuCores'])->label('CPU Cores') ?>

