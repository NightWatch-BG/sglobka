<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Part */

$this->title = 'Add New ' . $role->role;

$this->params['breadcrumbs'][] = ['label' => 'Parts', 'url' => ['index', 'role_fk' => '']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="part-form">

	<?php $form = ActiveForm::begin(); ?>

	<?=
	$this->render('_form', [
	    'form' => $form,
	    'model' => $model,
	    'manufacturers' => $manufacturers,
	])
	?>
	<?php
	//var_dump($parametersData); 
	$formFields = array(
	    1 => '_cpu',
	    2 => '_motherboard',
	    3 => '_memory',
	    4 => '_storage',
	    5 => '_videoCard',
	    6 => '_case',
	    7 => '_psu',
	);
	echo '<h3>Parameters:</h3>';
	if (isset($formFields[$role->role_id])) {
	    echo $this->render($formFields[$role->role_id], [
		'form' => $form,
		'model' => $model,
		'parametersData' => $parametersData,
	    ]);
	} else {
	    throw new \yii\web\HttpException(404, 'No Form Found');
	}
	?>

	<div class="form-group">
	    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

    </div>
</div>
