<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Part */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'parameter_ids[ramType_id]')->radioList($parametersData['ramType'])->label('Memory Type') ?>

<?= $form->field($model, 'parameter_ids[ramSpeed_id]')->radioList($parametersData['ramSpeed'])->label('Memory Speed') ?>

<?= $form->field($model, 'parameter_ids[ramSize_id]')->radioList($parametersData['ramSize'])->label('Memory Modules Size') ?>

