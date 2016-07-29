<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnnouncementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Announcements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announcement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Announcement', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
		'attribute' =>'announcement',
		'value' => function($data){ return StringHelper::truncate($data->announcement, 150, ' ...'); }
	    ],
            'announcement_date',

            ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
        ],
    ]); ?>

</div>
