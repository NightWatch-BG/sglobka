<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
	    'task_id',
            'title',
//            'status_fk',
	    [
		'label' => 'Status',
		'value' => function($model) {
		    return $model->statusForIndex($model['status_fk']);
		}
	    ],
            'due_date',
//            'assigned_from',
	    [
		'label' => 'Author',
		'value' => 'assignedFrom.last_name',
	    ],
	    [
		'label' => 'Assignee',
		'value' => 'assignedTo.last_name',
	    ],
//            'assignedTo.last_name',
            // 'last_update',
	    ['class' => 'yii\grid\ActionColumn',
		'template' => '{view}'],
        ],
    ]); ?>
</div>
