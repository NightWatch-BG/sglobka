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
        <?= Html::a('Edit user info', ['update', 'id' => $modelUser->user_id], ['class' => 'btn btn-primary']) ?>
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
            'last_update',
	    'userTypeFk.user_type',
            //'user_type_fk',
        ],
    ]) ?>

</div>
<h1><?= Html::encode('Address: ') ?></h1>
<div class="address-view">
    <?php if($modelAddress!= NULL): ?>

        <?= DetailView::widget([
            'model' => $modelAddress,
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
        <p>
            <?= Html::a('Edit Address', ['/address/update',  'id' => $modelAddress->address_id], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php else: ?>
        <p>
            <?= Html::a('Add Address', ['/address/create'], ['class' => 'btn btn-success']) ?>
         </p>
    <?php endif; ?>
</div>
