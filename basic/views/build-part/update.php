<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BuildPart */

$this->title = 'Update Build Part: ' . ' ' . $model->build_part_id;
$this->params['breadcrumbs'][] = ['label' => 'Build Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->build_part_id, 'url' => ['view', 'id' => $model->build_part_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="build-part-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
