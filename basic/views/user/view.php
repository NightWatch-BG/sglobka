<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $modelUser app\models\User */
/* @var $modelAddress app\models\Address */

$this->title = $modelUser->username . ' - Sqlobka User';
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'User';
?>
<div class="user-view">

    <h1><?= Html::encode('Username: ' . $modelUser->username) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $modelUser->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $modelUser->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $modelUser,
        'attributes' => [
            //'user_id',
            'username',
            'first_name',
            'last_name',
            //'password',
            //'salt',
            //'auth_key',
            'registration_date',
	    'userTypeFk.user_type',
            //'user_type_fk',
            'last_update',
        ],
    ]) ?>

</div>

    <p>
        <?= Html::a('Add Address', ['/address/create'], ['class' => 'btn btn-success']) ?>
    </p>
  

<div class="address-view">

    <?= DetailView::widget([
        'model' => $modelUser,
        'attributes' => [
            //'address_id',
            'addressFk.email:email',
            'addressFk.phone',
	    'addressFk.countryFk.country',
            'addressFk.cityFk.city',
            'addressFk.address',
            'addressFk.address2',
            'addressFk.last_update',
        ],
    ]) ?>
    
    <?php
    /*$this->render('//address/view', [
            'model' => $modelAddress,
        ]);
    */?>
</div>
