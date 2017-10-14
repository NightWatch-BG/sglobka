<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
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
            'guide_fk',
            'userFk.username',
            'rating',
	    [
		'attribute' =>'review',
		'value' => function($data){ return StringHelper::truncate($data->review, 200, ' ...'); }
	    ],
	    ['class' => 'yii\grid\ActionColumn',
		'template' => '{view}',],
        ],
    ]); ?>
</div>
