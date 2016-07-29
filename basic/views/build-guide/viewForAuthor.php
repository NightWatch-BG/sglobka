<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

use app\models\Role;

/* @var $this yii\web\View */
/* @var $model app\models\BuildGuide */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Build Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="build-guide-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?= Html::encode('Description: ') ?></h3>
    <p><?= Html::encode($model->guide) ?></p>
    <h4><?= Html::encode('Visibility: ' . $model->visibilityFk->visibility) ?></h4>
    <p>
	<?= Html::a('Update', ['update', 'id' => $model->build_guide_id], ['class' => 'btn btn-primary']) ?>
	<?=
	Html::a('Delete', ['delete', 'id' => $model->build_guide_id], [
	    'class' => 'btn btn-danger',
	    'data' => [
		'confirm' => 'Are you sure you want to delete this item?',
		'method' => 'post',
	    ],
	])
	?>
    </p>
    <h3><?= Html::encode('Components: ') ?></h3>
    <p>
	<?= GridView::widget([
	    'dataProvider' => $parts,
	    'columns' => [
		['class' => 'yii\grid\SerialColumn'],
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
		['class' => 'yii\grid\ActionColumn',
		    'template' => '{change}',
		    'buttons' => [		
			'change' => function ($url, $model, $key) {
			    // TO DO: build_id-to da e v sesiq i da se vzima ot tam, a da ne se podawa prez URL i navsqkyde kydeto se podawa da se oprawi
			    $url = \yii\helpers\Url::toRoute(['/part/index/', 'role_fk' => $model->role_fk]);
			    return Html::a('<span class="glyphicon glyphicon-transfer"></span>', $url);
			}
		    ],
		],
	    ],
	]);?>
    </p>
 
    <!--p>
	<h4><?= Html::encode('CPU: ') ?></h4>
	<?php if (array_key_exists('CPU', $parts)): ?>
	    <?= DetailView::widget([
		'model' => $parts['CPU'],
		'attributes' => [
		    'name',
		],
	    ])
	    ?>
	    <?= Html::a('Change the CPU', ['/build-part/delete-build-part-lnk/', 'part_id' => $parts['CPU']->part_id, 'build_id' => $model->build_guide_id, 'role_fk' => Role::CPU], ['class' => 'btn btn-warning']) ?>
	    <?= Html::a('For more info see the component page', ['/part/view/', 'id' => $parts['CPU']->part_id], ['class' => 'btn btn-info']) ?>
	<?php else: ?>
	    <?= Html::a('Choose a CPU', ['/part/index/', 'role_fk' => Role::CPU, 'build' => $model->build_guide_id], ['class' => 'btn btn-info']) ?>
	<?php endif; ?>
	
	
	<h4><?= Html::encode('Motherboard: ') ?></h4>
	<?php if (array_key_exists('Motherboard', $parts)): ?>
	    <?= DetailView::widget([
		'model' => $parts['Motherboard'],
		'attributes' => [
		    'name',
		],
	    ])
	    ?>
	    <?= Html::a('Change the Motherboard', ['/build-part/delete-build-part-lnk/', 'part_id' => $parts['Motherboard']->part_id, 'build_id' => $model->build_guide_id, 'role_fk' => Role::MOTHERBOARD], ['class' => 'btn btn-warning']) ?>
	    <?= Html::a('For more info see the component page', ['/part/view/', 'id' => $parts['Motherboard']->part_id], ['class' => 'btn btn-info']) ?>
	<?php else: ?>
	    <?= Html::a('Choose a Motherboard', ['/part/index/', 'role_fk' => Role::MOTHERBOARD, 'build' => $model->build_guide_id], ['class' => 'btn btn-info']) ?>
	<?php endif; ?>
	
	
	<h4><?= Html::encode('Memory: ') ?></h4>
	<?php if (array_key_exists('Memory', $parts)): ?>
	    <?= DetailView::widget([
		'model' => $parts['Memory'],
		'attributes' => [
		    'name',
		],
	    ])
	    ?>
	    <?= Html::a('Change the Memory', ['/build-part/delete-build-part-lnk/', 'part_id' => $parts['Memory']->part_id, 'build_id' => $model->build_guide_id, 'role_fk' => Role::MEMORY], ['class' => 'btn btn-warning']) ?>
	    <?= Html::a('For more info see the component page', ['/part/view/', 'id' => $parts['Memory']->part_id], ['class' => 'btn btn-info']) ?>
	<?php else: ?>
	    <?= Html::a('Choose a Memory', ['/part/index/', 'role_fk' => Role::MEMORY, 'build' => $model->build_guide_id], ['class' => 'btn btn-info']) ?>
	<?php endif; ?>
	
	
	<h4><?= Html::encode('Storage: ') ?></h4>
	<?php if (array_key_exists('Storage', $parts)): ?>
	    <?= DetailView::widget([
		'model' => $parts['Storage'],
		'attributes' => [
		    'name',
		],
	    ])
	    ?>
	    <?= Html::a('Change the Storage', ['/build-part/delete-build-part-lnk/', 'part_id' => $parts['Storage']->part_id, 'build_id' => $model->build_guide_id, 'role_fk' => Role::STORAGE], ['class' => 'btn btn-warning']) ?>
	    <?= Html::a('For more info see the component page', ['/part/view/', 'id' => $parts['Storage']->part_id], ['class' => 'btn btn-info']) ?>
	<?php else: ?>
	    <?= Html::a('Choose a Storage', ['/part/index/', 'role_fk' => Role::STORAGE, 'build' => $model->build_guide_id], ['class' => 'btn btn-info']) ?>
	<?php endif; ?>
	
	
	<h4><?= Html::encode('Video Card: ') ?></h4>
	<?php if (array_key_exists('Video card', $parts)): ?>
	    <?= DetailView::widget([
		'model' => $parts['Video card'],
		'attributes' => [
		    'name',
		],
	    ])
	    ?>
	    <?= Html::a('Change the Video card', ['/build-part/delete-build-part-lnk/', 'part_id' => $parts['Video card']->part_id, 'build_id' => $model->build_guide_id, 'role_fk' => Role::VIDEO_CARD], ['class' => 'btn btn-warning']) ?>
	    <?= Html::a('For more info see the component page', ['/part/view/', 'id' => $parts['Video card']->part_id], ['class' => 'btn btn-info']) ?>	
	<?php else: ?>
	    <?= Html::a('Choose a Video Card', ['/part/index/', 'role_fk' => Role::VIDEO_CARD, 'build' => $model->build_guide_id], ['class' => 'btn btn-info']) ?>
	<?php endif; ?>
	
	
	<h4><?= Html::encode('Case: ') ?></h4>
	<?php if (array_key_exists('Case', $parts)): ?>
	    <?= DetailView::widget([
		'model' => $parts['Case'],
		'attributes' => [
		    'name',
		],
	    ])
	    ?>
	    <?= Html::a('Change the Case', ['/build-part/delete-build-part-lnk/', 'part_id' => $parts['Case']->part_id, 'build_id' => $model->build_guide_id, 'role_fk' => Role::PC_CASE], ['class' => 'btn btn-warning']) ?>
	    <?= Html::a('For more info see the component page', ['/part/view/', 'id' => $parts['Case']->part_id], ['class' => 'btn btn-info']) ?>	
	<?php else: ?>
	    <?= Html::a('Choose a Case', ['/part/index/', 'role_fk' => Role::PC_CASE, 'build' => $model->build_guide_id], ['class' => 'btn btn-info']) ?>
	<?php endif; ?>
	
	
	<h4><?= Html::encode('PSU: ') ?></h4>
	<?php if (array_key_exists('PSU', $parts)): ?>
	    <?= DetailView::widget([
		'model' => $parts['PSU'],
		'attributes' => [
		    'name',
		],
	    ])
	    ?>
	    <?= Html::a('Change the PSU', ['/build-part/delete-build-part-lnk/', 'part_id' => $parts['PSU']->part_id, 'build_id' => $model->build_guide_id, 'role_fk' => Role::PSU], ['class' => 'btn btn-warning']) ?>
	    <?= Html::a('For more info see the component page', ['/part/view/', 'id' => $parts['PSU']->part_id], ['class' => 'btn btn-info']) ?>	
	<?php else: ?>
	    <?= Html::a('Choose a PSU', ['/part/index', 'role_fk' => Role::PSU, 'build' => $model->build_guide_id], ['class' => 'btn btn-info']) ?>
	<?php endif; ?>
    </p-->
    <?php if (!empty($parts) && $haveAddress): ?>
	<?= Html::a('Order this build', ['/order/create', 'build_id' => $model->build_guide_id],['class' => 'btn btn-success']) ?>	
    <?php endif; ?>
 <?php    
//echo GridView::widget(['dataProvider' => $parts,]);
//var_dump($haveAddress);
 ?>
    
</div>
