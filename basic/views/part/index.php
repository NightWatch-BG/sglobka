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
    <?php if(Yii::$app->user->identity && (Yii::$app->user->identity->isAdmin() || Yii::$app->user->identity->isStaff())): ?>
	<p>
	    <?= Html::a('Add New Part', ['create', 'role' => Role::ANY], ['class' => 'btn btn-success']) ?>
	</p>
    <?php endif; ?>
    <?= GridView::widget([
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
            ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
        ],
    ]); ?>

</div>
