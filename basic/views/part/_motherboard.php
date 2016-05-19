<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Part */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'parameter_ids[cpuSocket_id]')->dropDownList($parametersData['cpuSockets'], ['prompt' => '--- Select CPU Socket ---'])->label('CPU Socket') ?>

<?= $form->field($model, 'parameter_ids[mbFormFactor_id]')->radioList($parametersData['mbFormFactor'])->label('Form Factor') ?>

<?= $form->field($model, 'parameter_ids[mbChipset_id]')->dropDownList($parametersData['mbChipset'], ['prompt' => '--- Select Chipset ---'])->label('Chipset') ?>

<?= $form->field($model, 'parameter_ids[ramSlots_id]')->radioList($parametersData['ramSlots'])->label('Memory Slots') ?>

<?= $form->field($model, 'parameter_ids[ramType_id]')->radioList($parametersData['ramType'])->label('Memory Slots Type') ?>

<?= $form->field($model, 'parameter_ids[ramMax_id]')->radioList($parametersData['ramMax'])->label('Maximum Supported Memory') ?>

<?= $form->field($model, 'mb_ram_speed')->checkboxList($parametersData['ramSpeed'])->label('Supported Memory Speeds') ?>

