<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'order_id',
            'customerFk.username',
            //'staff_fk',
            //'build_fk',
            'statusFk.status',
            // 'notes',
            'date_of_order',
            'last_update',

            ['class' => 'yii\grid\ActionColumn',
		'template' => '{view}'],
            ['class' => 'yii\grid\ActionColumn',
		'template' => '{update}',
		'visible' => Yii::$app->user->identity->isStaff(),
		],
        ],
    ]); ?>

</div>
