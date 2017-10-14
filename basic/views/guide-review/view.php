<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GuideReview */

$this->title = 'Build Review';
$this->params['breadcrumbs'][] = ['label' => 'Guides', 'url' => ['build-guide/index', 'visibility_fk' => 1]];
$this->params['breadcrumbs'][] = ['label' => 'Guide Reviews', 'url' => ['index', 'guide_fk' => $model->guide_fk]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guide-review-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Yii::$app->user->identity && Yii::$app->user->identity->isCreator($model->user_fk)): ?>
	<p>
	    <?= Html::a('Update', ['update', 'id' => $model->guide_review_id], ['class' => 'btn btn-primary']) ?>
	</p>
    <?php endif ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'userFk.username',
            'guideFk.title',
            'review',
            'rating',
        ],
    ]) ?>
    <p>
	<?= Html::a('Go to build', ['build-guide/view', 'id' => $model->guide_fk], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
