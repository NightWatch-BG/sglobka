<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BuildGuide */

$this->title = 'Name your system build';
$this->params['breadcrumbs'][] = ['label' => 'Build Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-guide-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::encode('Give a name to your build. If you want this build to be public - add description in the Guide field.'
	    . ' If you want this build to be private - leave Guide empty.') ?></p>  
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
