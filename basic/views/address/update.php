<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Address */

$this->title = 'Update Address of User: ' . ' ' . \Yii::$app->user->identity->username;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['/user/view', 'id' => \Yii::$app->user->identity->user_id]];
//$this->params['breadcrumbs'][] = ['label' => 'Addresses', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->address_id, 'url' => ['view', 'id' => $model->address_id]];
$this->params['breadcrumbs'][] = 'Update Address';
?>
<div class="address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
	'countries' => $countries,
	'cities' => $cities,        
    ]) ?>

</div>
