<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Part */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'parameter_ids[vcChipset_id]')->radioList($parametersData['vcChipset'])->label('Chipset') ?>

<?= $form->field($model, 'parameter_ids[vcVram_id]')->radioList($parametersData['vcVram'])->label('VRAM') ?>

<?= $form->field($model, 'parameter_ids[vcInterface_id]')->radioList($parametersData['vcInterface'])->label('Interface') ?>

<?= $form->field($model, 'parameter_ids[vcSliCrossfire_id]')->radioList($parametersData['vcSliCrossfire'])->label('Sli/Crossfire') ?>

<?= $form->field($model, 'parameter_ids[vcDisplayPorts_id]')->radioList($parametersData['vcDisplayPorts'])->label('Display Ports') ?>

<?= $form->field($model, 'parameter_ids[vcMiniDisplayPorts_id]')->radioList($parametersData['vcMiniDisplayPorts'])->label('Mini Display Ports') ?>

<?= $form->field($model, 'parameter_ids[vcHdmi_id]')->radioList($parametersData['vcHdmi'])->label('HDMI Ports') ?>

<?= $form->field($model, 'parameter_ids[vcMiniHdmi_id]')->radioList($parametersData['vcMiniHdmi'])->label('Mini HDMI Ports') ?>

<?= $form->field($model, 'parameter_ids[vcDvi_id]')->radioList($parametersData['vcDvi'])->label('DVI Ports') ?>

<?= $form->field($model, 'parameter_ids[vcSlotsWidth_id]')->radioList($parametersData['vcSlotsWidth'])->label('Expansion Slot Width') ?>

