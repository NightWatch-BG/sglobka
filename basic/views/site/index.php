<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use app\models\Role;

$this->title = 'Sglobka - Custom Personal Computer Systems';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>SHOP!</h1>
        <p class="lead">View for the clients - by default and after login in client.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Build your custom PC</h2>
		<?php if (!Yii::$app->user->isGuest): ?>
		    <p>
			<?= Html::a('Create a PC Build', ['/build-guide/create/'], ['class' => 'btn btn-success']) ?>
			<?= Html::a('See my builds', ['/build-guide/index/'], ['class' => 'btn btn-info']) ?>
			
		    </p>
		<?php else: ?>
		    <p>
			<?= Html::encode('Login to start building!') ?>
		    </p>
		<?php endif; ?>
            </div>
            <div class="col-lg-4">
                <h2>Browse the Build Guides</h2>
		<h4>Newest Build Guide</h4>
		<?php if ($lastBuildGuide): ?>
		    <h4> <?= $lastBuildGuide->title ?> </h4>
		    <p> <?= $lastBuildGuide->guide ?> </p>
		    <p> Author: <?= $lastBuildGuide->userFk->username ?></p>
		<?php else: ?>
		    <p> <?= Html::encode('No announcements yet') ?> </p>
		<?php endif; ?>
		<p>
		    <?= Html::a('See all Build Guides', ['/build-guide/index/'], ['class' => 'btn btn-info']) ?>
		</p>
	    </div>
            <div class="col-lg-4">
                <h2>Parts in Stock</h2>

                <p>
		    <?= Html::a('See All CPUs', ['/part/index/', 'role_fk' => Role::CPU], ['class' => 'btn btn-info']) ?>
		    <?= Html::a('See All Motherboards', ['/part/index/', 'role_fk' => Role::MOTHERBOARD], ['class' => 'btn btn-info']) ?>
		</p>    
                <p>
		    <?= Html::a('See All Memorys', ['/part/index/', 'role_fk' => Role::MEMORY], ['class' => 'btn btn-info']) ?>
		    <?= Html::a('See All Storages', ['/part/index/', 'role_fk' => Role::STORAGE], ['class' => 'btn btn-info']) ?>
		</p>    
                <p>
		    <?= Html::a('See All Video Cards', ['/part/index/', 'role_fk' => Role::VIDEO_CARD], ['class' => 'btn btn-info']) ?>
		    <?= Html::a('See All Cases', ['/part/index/', 'role_fk' => Role::PC_CASE], ['class' => 'btn btn-info']) ?>
		</p>    
		<p>
		    <?= Html::a('See All PSUs', ['/part/index', 'role_fk' => Role::PSU], ['class' => 'btn btn-info']) ?>
		</p>
		<p>
		    <?= Html::a('All Parts', ['/part/index', 'role_fk' => ''], ['class' => 'btn btn-info']) ?>
		</p>
            </div>
        </div>

    </div>
</div>
