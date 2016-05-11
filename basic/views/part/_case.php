<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Part */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'parameter_ids[mbFormFactor_id]')->radioList($parametersData['mbFormFactor'])->label('Motherboard Form Factor') ?>

<?= $form->field($model, 'parameter_ids[caseType_id]')->radioList($parametersData['caseType'])->label('Case Type') ?>

