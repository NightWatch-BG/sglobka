<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BuildPart */

$this->title = $model->build_part_id;
$this->params['breadcrumbs'][] = ['label' => 'Build Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-part-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->build_part_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->build_part_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'build_part_id',
            'build_guide_fk',
            'part_fk',
        ],
    ]) ?>

</div>
