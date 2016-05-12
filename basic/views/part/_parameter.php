<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
	[
	    'label' => $model->parameterNameFk->parameter_name,
	    'value' => $model->parameter_value,
	],
    ],
]);
