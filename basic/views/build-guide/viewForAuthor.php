<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

use app\models\Role;

/* @var $this yii\web\View */
/* @var $model app\models\BuildGuide */

$this->title = $build->title;
//$this->params['breadcrumbs'][] = ['label' => 'Build Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="build-guide-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?= Html::encode('Description: ') ?></h3>
    <p><?= Html::encode($build->guide) ?></p>
    <h4><?= Html::encode('Visibility: ' . $build->visibilityFk->visibility) ?></h4>

	<?php if (!($build->in_order)): ?>
        <p>
	    <?= Html::a('Update', ['update', 'id' => $build->build_guide_id], ['class' => 'btn btn-primary']) ?>
	    <?=
	    Html::a('Delete', ['delete', 'id' => $build->build_guide_id], [
		'class' => 'btn btn-danger',
		'data' => [
		    'confirm' => 'Are you sure you want to delete this item?',
		    'method' => 'post',
		],
	    ])
	    ?>
	</p>
	<p>
	    <?php if (!($parts->totalCount < 1) && $haveAddress): ?>
		    <?= Html::a('Order this build', ['/order/create', 'build_id' => $build->build_guide_id],['class' => 'btn btn-success']) ?>
	    <?php endif; ?>
	</p>
	<p>
	    <?php
	    foreach ($roles as $role => $role_id) {
		$buildHaveIt = FALSE;
		foreach ($parts->keys as $key) {
		    if ($role_id == $key) {
			$buildHaveIt = TRUE;
		    }
		}
		if (!$buildHaveIt) {
		    echo Html::a('Add ' . $role, ['/part/index/', 'role_fk' => $role_id], ['class' => 'btn btn-info']) . '&emsp;';
		}
	    }
	    ?>
	</p>
	<?php else : ?>
	    <h3> <?= Html::encode('Note: This build (parts list) is in order and can\'t be edited.') ?></h3>
	    <p> <?= Html::encode('See your orders for more information.') ?></p>
	    <p> <?= Html::a('My Orders', ['/order/index', 'customer_fk' => Yii::$app->user->identity->user_id],['class' => 'btn btn-success']) ?></p>
	<?php endif; ?>
    
    <h3><?= Html::encode('Components: ') ?></h3>
	<?= GridView::widget([
	    'dataProvider' => $parts,
	    'columns' => [
		'roleFk.role',
		'name',
		'part_number',
		//'model',
		'manufacturerFk.manufacturer_name',
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
		['class' => 'yii\grid\ActionColumn',
		    'template' => '{change}',
		    'buttons' => [		
			'change' => function ($url, $model, $key) {
			    $url = \yii\helpers\Url::toRoute(['/part/index/', 'role_fk' => $model->role_fk, 'old_part' => $model->part_id]);
			    return Html::a('<span class="glyphicon glyphicon-transfer"></span>', $url);
			}
		    ],
		    'visible' => $build->in_order ? FALSE : TRUE
		],
	    ],
	]);?>
 <?php    
//echo GridView::widget(['dataProvider' => $parts,]);
//var_dump($parts);
 ?>
    
</div>
