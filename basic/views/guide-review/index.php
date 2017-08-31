<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GuideReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guide Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guide-review-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'userFk.username',
            'rating',
            'review',
        ],
    ]); ?>
</div>
