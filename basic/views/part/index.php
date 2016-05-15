<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Role;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (Yii::$app->user->identity && (Yii::$app->user->identity->isAdmin() || Yii::$app->user->identity->isStaff())): ?>
        <p>
	    <?= Html::a('Add New CPU', ['/part/create/', 'role' => Role::CPU], ['class' => 'btn btn-success']) ?>
	    <?= Html::a('Add New Motherboard', ['/part/create/', 'role' => Role::MOTHERBOARD], ['class' => 'btn btn-success']) ?>
	    <?= Html::a('Add New Memory', ['/part/create/', 'role' => Role::MEMORY], ['class' => 'btn btn-success']) ?>
	    <?= Html::a('Add New Storage', ['/part/create/', 'role' => Role::STORAGE], ['class' => 'btn btn-success']) ?>
	    <?= Html::a('Add New Video Card', ['/part/create/', 'role' => Role::VIDEO_CARD], ['class' => 'btn btn-success']) ?>
	    <?= Html::a('Add New Case', ['/part/create/', 'role' => Role::PC_CASE], ['class' => 'btn btn-success']) ?>
	    <?= Html::a('Add New PSU', ['/part/create', 'role' => Role::PSU], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
    <?=
    GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
	    ['class' => 'yii\grid\SerialColumn'],
	    //'part_id',
	    'name',
	    'part_number',
	    'model',
	    'manufacturerFk.manufacturer_name',
	    'roleFk.role',
	    'overal_rating',
	    // 'more_info',
	    'price',
	    [
	    'class' => 'yii\grid\ActionColumn',
	    'template' => '{view}',
	    'buttons' => [
                        'view' => function ($url, $model) use ($build) {
                            $url .= '?build=' . $build; 
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url);
			},],
	    ],
	],
    ]);
    ?>
 <?php  
// echo yii\helpers\Url::to(['part/view', 'id' => 1, 'build' => 3]);
// var_dump($build); ?>
</div>
