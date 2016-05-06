<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Edit User: ' . ' ' . $model->username;
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Edit Info';
?>

<div class="edit-user-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>
    <?php if($model->user_id === Yii::$app->user->identity->user_id): ?>
    
	<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    
    <?php endif; ?>
    
    <?php if(Yii::$app->user->identity->isAdmin()): ?>
	<h3> <?= 'User: ' . $model->username . ' is' ?> </h3>
	<?= $form->field($model, 'user_type_fk')->dropDownList($userTypes, ['prompt' => '--- Select user type ---']) ?>
    <?php endif; ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>