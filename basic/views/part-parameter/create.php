<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartParameter */

$this->title = 'Create Part Parameter';
$this->params['breadcrumbs'][] = ['label' => 'Part Parameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-parameter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
