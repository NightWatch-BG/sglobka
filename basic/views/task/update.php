<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = 'Update Task: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->task_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->identity->isAdmin() || Yii::$app->user->identity->isCreator($model->assigned_from)): ?>
    <?= $this->render('_form', [
        'model' => $model,
	'assignees' => $assignees,
	'status' => $status,
    ]) ?>
    <?php else: ?>
    <?= $this->render('_formAssignee', [
        'model' => $model,
	'assignees' => $assignees,
	'status' => $status,
    ]) ?>
    <?php endif ?>
</div>
