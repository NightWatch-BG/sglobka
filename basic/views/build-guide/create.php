<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BuildGuide */

$this->title = 'Create Build Guide';
$this->params['breadcrumbs'][] = ['label' => 'Build Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-guide-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
