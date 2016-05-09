<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartParameterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Part Parameters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-parameter-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Part Parameter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'part_parameter_id',
            'part_fk',
            'parameter_fk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
