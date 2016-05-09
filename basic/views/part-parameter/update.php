<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PartParameter */

$this->title = 'Update Part Parameter: ' . ' ' . $model->part_parameter_id;
$this->params['breadcrumbs'][] = ['label' => 'Part Parameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->part_parameter_id, 'url' => ['view', 'id' => $model->part_parameter_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="part-parameter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
