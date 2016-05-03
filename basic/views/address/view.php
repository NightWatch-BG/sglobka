<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Address */

$this->title = \Yii::$app->user->identity->username . ' Address';
//$this->params['breadcrumbs'][] = ['label' => 'Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['/user/view', 'id' => \Yii::$app->user->identity->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->address_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'address_id',
            'email:email',
            'phone',
	    'countryFk.country',
            'cityFk.city',
	    'address',
            'address2',
            'last_update',
        ],
    ]) ?>

</div>
