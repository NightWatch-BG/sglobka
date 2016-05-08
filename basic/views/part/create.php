<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Part */

if(count($roles) > 1) {
    $this->title = 'Add Part';
} else {
    $this->title = 'Add ' . reset($roles);
}

$this->params['breadcrumbs'][] = ['label' => 'Parts', 'url' => ['index', 'role_fk' => '']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
	'manufacturers' => $manufacturers,
	'roles' => $roles,
    ]) ?>

</div>
