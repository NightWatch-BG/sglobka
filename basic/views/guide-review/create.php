<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GuideReview */

$this->title = 'Create Guide Review';
$this->params['breadcrumbs'][] = ['label' => 'Guide Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guide-review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
