<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BuildGuide */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Build Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="build-guide-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::encode('Author: ' . $model->userFk->username) ?></p>
    <h3><?= Html::encode('Description: ') ?></h3>
    <p><?= Html::encode($model->guide) ?></p>
    <h3><?= Html::encode('Components: ') ?></h3>
    <p>
	<?php 
	foreach ($parts as $key => $part) {
	    echo '<h4>' . Html::encode($key) . '</h4>';
	    echo DetailView::widget([
		'model' => $part,
		'attributes' => [
		    'name',
		],
		]);
	}
	?>
    </p>
</div>
