<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Parameter */

$this->title = 'Update Parameter: ' . ' ' . $model->parameter_id;
$this->params['breadcrumbs'][] = ['label' => 'Parameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parameter_id, 'url' => ['view', 'id' => $model->parameter_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parameter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
