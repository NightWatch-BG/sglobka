<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Order';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->identity && Yii::$app->user->identity->isStaff()): ?>
    <!--p>
        <?= Html::a('Update', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p-->
    <?php endif; ?>
    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_id',
	    [
	    'label' => 'Customer',
	    'value' => $model->customerFk->username,
	    ],
            'buildFk.title',
            'statusFk.status',
            'notes',
            //'staff_notes',
            'date_of_order',
            'last_update',
        ],
    ]);
    if($model->staff_fk){
	echo Html::encode('Employee in charge for your order: ' . $model->staffFk->first_name . ' ' . $model->staffFk->last_name);
    } else {
	echo Html::encode('Your order is queued awaiting processing!');
    }
    ?>

</div>
