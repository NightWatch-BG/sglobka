<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Order';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    /*
    if (Yii::$app->user->identity && Yii::$app->user->identity->isStaff()) {
        echo Html::a('Update', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']);
        echo Html::a('Delete', ['delete', 'id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
    }
    */
    ?>
    <?php
    echo '<h3>' . Html::encode('Contacts: ') . '</h3>';
    echo DetailView::widget([
        'model' => $address,
        'attributes' => [
	    'userFk.first_name',
	    'userFk.last_name',
	    'email',
	    'phone',
	    'address',
	    'countryFk.country',
	    'cityFk.city'
	],
    ]);
    echo '<h3>' . Html::encode('Order info: ') . '</h3>';
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
    echo '<h3>' . Html::encode('Components: ') . '</h3>';
    echo GridView::widget([
	    'dataProvider' => $parts,
	    'columns' => [
		'roleFk.role',
		'name',
		'part_number',
		//'model',
		//'manufacturerFk.manufacturer_name',
		//'overal_rating',
		'price',
		['class' => 'yii\grid\ActionColumn',
		    'template' => '{view}',
		    'buttons' => [
			'view' => function ($url, $model, $key) {
			    $url = \yii\helpers\Url::toRoute(['/part/view/', 'id' => $model->part_id]);
			    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url);
			},
		    ],
		],
	    ],
	]);
    if($model->staff_fk){
	echo Html::encode('Employee in charge for your order: ' . $model->staffFk->first_name . ' ' . $model->staffFk->last_name);
    } else {
	echo Html::encode('Your order is queued awaiting processing!');
    }
    ?>

</div>
