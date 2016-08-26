<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
    <?= DetailView::widget([
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
    ?>
     <?php
     //var_dump($build);
     //var_dump($build2);
 ?>
    <h3><?= Html::encode('Components: ') ?></h3>
    
    <p>
	<?= GridView::widget([
	    'dataProvider' => $parts,
	    'columns' => [
		'roleFk.role',
		'name',
		'part_number',
		//'model',
		'manufacturerFk.manufacturer_name',
		'overal_rating',
		'price',
	    ],
	]);?>
    </p>
    
    <p>
	<?php
	$total = 0;
	$partData = $parts->getModels();
	foreach ($partData as $part) {
	    $total += $part->price;
	}
	echo '<h4>' . Html::encode('Total price: ' . $total) . '</h4>';
	?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
