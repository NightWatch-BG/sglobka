<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Part */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Parts', 'url' => ['index', 'role_fk' => '']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= DetailView::widget([
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
    ]) ?>
    
    <?php if(Yii::$app->user->identity && (Yii::$app->user->identity->isAdmin() || Yii::$app->user->identity->isStaff())): ?>
    <p>
	<?= Html::a('Add New', ['/part/create/', 'role' => $model->role_fk], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
	<?= Html::a('Update', ['update', 'id' => $model->part_id], ['class' => 'btn btn-primary']) ?>
	<?= Html::a('Delete', ['delete', 'id' => $model->part_id], [
	    'class' => 'btn btn-danger',
	    'data' => [
		'confirm' => 'Are you sure you want to delete this item?',
		'method' => 'post',
	    ],
	]) ?>
    </p>
    <?php endif; ?>

</div>
