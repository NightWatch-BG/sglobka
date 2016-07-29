<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Create Order';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1>Are you sure you want to make the following order:</h1>
    <h3><?= Html::encode('Owner: ' . $build->userFk->username) ?></h3>
    <h4><?= Html::encode('Address: ' . $address) ?></h4>
    
    <h3><?= Html::encode('Components: ') ?></h3>
    <p>
	<?php 
	$total = 0;
	foreach ($parts as $key => $part) {
	    $total += $part->price;
	    echo '<h4>' . Html::encode($key) . '</h4>';
	    echo DetailView::widget([
		'model' => $part,
		'attributes' => [
		    'name',
		    'price',
		],
		]);
	}
	echo '<h4>' . Html::encode('Total price: ' . $total) . '</h4>';
	?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
