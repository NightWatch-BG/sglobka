<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\BuildGuide */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Build Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-guide-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::encode('Author: ' . $model->userFk->username) ?></p>
    <h3><?= Html::encode('Description: ') ?></h3>
    <p><?= Html::encode($model->guide) ?></p>
    <h3><?= Html::encode('Components: ') ?></h3>
    
    <p>
	<?= GridView::widget([
	    'dataProvider' => $parts,
	    'columns' => [
		'roleFk.role',
		'name',
		//'part_number',
		//'model',
		//'manufacturerFk.manufacturer_name',
		'overal_rating',
		'price',
		['class' => 'yii\grid\ActionColumn',
		    'template' => '{view}',
		    'buttons' => [
			'view' => function ($url, $model, $key) {
			    $url = \yii\helpers\Url::toRoute(['/part/view/', 'id' => $model->part_id]);
			    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url);
			},
		    ],
		],
	    ],
	]);?>
    </p>
    
</div>
