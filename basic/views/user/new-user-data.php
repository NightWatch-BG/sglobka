<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $modelUser app\models\User */

$this->title = 'You registered new user ';
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'User';
?>
<div class="user-view">

    <h1><?= Html::encode('You registered new user with the following data ') ?></h1>

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
            //'last_update',
        ],
    ]) ?>

</div>
<?= Html::a('Login', ['/site/login'], ['class' => 'btn btn-primary']) ?>