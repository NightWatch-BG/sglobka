<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Announcement */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Announcements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announcement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
	<?php if(Yii::$app->user->identity->isCreator($model->user_fk)): ?>
	    <?= Html::a('Update', ['update', 'id' => $model->announcement_id], ['class' => 'btn btn-primary']) ?>
	    <?= Html::a('Delete', ['delete', 'id' => $model->announcement_id], [
		'class' => 'btn btn-danger',
		'data' => [
		    'confirm' => 'Are you sure you want to delete this item?',
		    'method' => 'post',
		],
	    ]) ?>
	<?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'userFk.username',
            'title',
            'announcement',
            'announcement_date',
        ],
    ]) ?>

</div>
