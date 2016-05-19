<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Part */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'case_mb_form_factor')->checkboxList($parametersData['mbFormFactor'])->label('Motherboard Form Factor') ?>

<?= $form->field($model, 'parameter_ids[caseType_id]')->radioList($parametersData['caseType'])->label('Case Type') ?>

