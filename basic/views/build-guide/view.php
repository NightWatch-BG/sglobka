<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BuildGuide */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Build Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-guide-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::encode('Author: ' . $model->userFk->username) ?></p>
    <p><?= Html::encode('Rating: '. $model->avr_rating .'('. $model->ratings_count .')') ?></p>
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
	<p>
	    <?= Html::a('See reviews', ['/guide-review/index/', 'guide_fk' => $model->build_guide_id], ['class' => 'btn btn-success']) ?>
	</p>
        <?php if (!Yii::$app->user->isGuest && !Yii::$app->user->identity->isCreator($model->user_fk)): ?>
	<h4>Your Rating / Review</h4>
	<?php if ($review): ?>
	    <?=
	    DetailView::widget([
		'model' => $review,
		'attributes' => [
		    'rating',
		    'review',
		],
	    ])
	    ?>
	    <p>
		<?= Html::a('Edit Review', ['/guide-review/update/', 'id' => $review->guide_review_id], ['class' => 'btn btn-info']) ?>
	    </p>
	<?php else: ?>
	    <p>
		<?= Html::a('Rate / Review this build', ['/guide-review/create/', 'build' => $model->build_guide_id], ['class' => 'btn btn-success']) ?>
	    </p>
	<?php endif; ?>

    <?php endif; ?>
</div>
