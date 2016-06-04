<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Part */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Parts', 'url' => ['index', 'role_fk' => '']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->identity && Yii::$app->user->identity->isStaff()): ?>
        <p>
	    <?= Html::a('Add New Part', ['/part/create/', 'role' => $model->role_fk], ['class' => 'btn btn-success']) ?>
        </p>
        <p>
	    <?= Html::a('Update', ['update', 'id' => $model->part_id], ['class' => 'btn btn-primary']) ?>
	    <?=
	    Html::a('Delete', ['delete', 'id' => $model->part_id], [
		'class' => 'btn btn-danger',
		'data' => [
		    'confirm' => 'Are you sure you want to delete this item?',
		    'method' => 'post',
		],
	    ])
	    ?>
        </p>
    <?php endif; ?>
    <?=
    DetailView::widget([
	'model' => $model,
	'attributes' => [
	    //'part_id',
	    'name',
	    'part_number',
	    'model',
	    'manufacturerFk.manufacturer_name',
	    'roleFk.role',
	    'overal_rating',
	    'more_info',
	    'price',
	],
    ])
    ?>

    <?=
    ListView::widget([
	'dataProvider' => $parameters,
	'itemView' => '_parameter',
    ])
    ?>
    <?php if (!Yii::$app->user->isGuest): ?>
	<h4>Your Rating / Review</h4>
	<?php if ($review != NULL): ?>
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
		<?= Html::a('Edit Review', ['/review/update/', 'id' => $review->review_id], ['class' => 'btn btn-info']) ?>
	    </p>
	<?php else: ?>
	    <p>
		<?= Html::a('Rate / Review this part', ['/review/create/', 'part' => $model->part_id], ['class' => 'btn btn-success']) ?>
	    </p>
	<?php endif; ?>
    <?php endif; ?>
    <p>
	<?= Html::a('See all reviews for this part', ['/review/index/', 'part' => $model->part_id], ['class' => 'btn btn-info']) ?>
    </p>
    
    <?php if (!Yii::$app->user->isGuest && $build != NULL): ?>
	<p>
	    <?= Html::a('Add this part to your build', ['/part/link-part/', 'build_id' => $build, 'part_id' => $model->part_id], ['class' => 'btn btn-info']) ?>
	</p>
    <?php endif; ?>

</div>
