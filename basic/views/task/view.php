<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
	<?php if ($model->isInTeam(Yii::$app->user->identity->user_id)): ?>
        <?= Html::a('Update', ['update', 'id' => $model->task_id], ['class' => 'btn btn-primary']) ?>
	<?php endif ?>
        <?php if (Yii::$app->user->identity->isCreator($model->assigned_from)): ?>
	<?= Html::a('Delete', ['delete', 'id' => $model->task_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
	<?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'task_id',
            'title',
            'description',
	    [
		'label' => 'Status',
		'value' => $status,
	    ],
            'due_date',
	    [
		'label' => 'Author',
		'value' => $author,
	    ],
	    [
		'label' => 'Assignee',
		'value' => $assignee,
	    ],
            'last_update',
        ],
    ]) ?>

</div>
