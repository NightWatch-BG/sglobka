<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GuideReview */

$this->title = 'Update Guide Review';
$this->params['breadcrumbs'][] = ['label' => 'Guides', 'url' => ['build-guide/index', 'visibility_fk' => 1]];
$this->params['breadcrumbs'][] = ['label' => 'Guide Reviews', 'url' => ['index', 'guide_fk' => $model->guide_fk]];
$this->params['breadcrumbs'][] = ['label' => 'My Review', 'url' => ['view', 'id' => $model->guide_review_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guide-review-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php if(Yii::$app->user->identity && Yii::$app->user->identity->isCreator($model->user_fk)): ?>
	<p>
	    <?= Html::a('Delete', ['delete', 'id' => $model->guide_review_id], [
		'class' => 'btn btn-danger',
		'data' => [
		    'confirm' => 'Are you sure you want to delete this item?',
		    'method' => 'post',
		],
	    ]) ?>
	</p>
    <?php endif ?>
</div>
