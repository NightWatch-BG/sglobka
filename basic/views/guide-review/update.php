<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GuideReview */

$this->title = 'Update Guide Review';
$this->params['breadcrumbs'][] = ['label' => 'Guide Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'My Review', 'url' => ['view', 'id' => $model->guide_review_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guide-review-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
