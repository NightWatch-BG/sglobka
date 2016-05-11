<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Part */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'parameter_ids[storageCapacity_id]')->radioList($parametersData['storageCapacity'])->label('Capacity') ?>

<?= $form->field($model, 'parameter_ids[storageType_id]')->radioList($parametersData['storageType'])->label('Type') ?>

<?= $form->field($model, 'parameter_ids[storageInterface_id]')->radioList($parametersData['storageInterface'])->label('Interface') ?>

<?= $form->field($model, 'parameter_ids[storageFormFactor_id]')->radioList($parametersData['storageFormFactor'])->label('Form Factor') ?>

