<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BuildGuide */

$this->title = 'Update Build Guide: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Build Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->build_guide_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="build-guide-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'visibility' => $visibility,
    ]) ?>

</div>
