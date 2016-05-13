<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BuildPart */

$this->title = 'Create Build Part';
$this->params['breadcrumbs'][] = ['label' => 'Build Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-part-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
