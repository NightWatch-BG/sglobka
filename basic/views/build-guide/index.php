<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BuildGuideSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Build Guides';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-guide-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (!Yii::$app->user->isGuest): ?>
	<p>
	    <?= Html::a('Create Build Guide', ['create'], ['class' => 'btn btn-success']) ?>
	</p>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'userFk.username',
	    [
		'attribute' =>'title',
		'value' => function($data){ return StringHelper::truncate($data->title, 30, ' ...'); }
	    ],
	    [
		'attribute' =>'guide',
		'value' => function($data){ return StringHelper::truncate($data->guide, 200, ' ...'); }
	    ],

	['class' => 'yii\grid\ActionColumn',
	    'template' => '{view}',],
        ],
    ]); ?>

</div>
