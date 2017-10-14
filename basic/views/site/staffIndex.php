<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\StringHelper;

use app\models\Role;
use \app\models\BuildGuide;

$this->title = 'Sglobka - Custom Personal Computer Systems';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>STAFF</h1>
        <p class="lead">View to show to admins and staff.</p>
    </div>

    <div class="body-content">

        <div class="row">
	    
	    <div class="col-lg-4">
                <h2>Build your custom PC</h2>
		<?php if (!Yii::$app->user->isGuest): ?>
		    <p>
			<?= Html::a('New PC Build', ['/build-guide/create/'], ['class' => 'btn btn-success']) ?>
		    </p>
		    <p>
			<?= Html::a('My builds', ['/build-guide/index/', 'user_fk' => Yii::$app->user->identity->user_id], ['class' => 'btn btn-info']) ?>
		    </p>
		<?php else: ?>
		    <p>
			<?= Html::encode('Login to start building!') ?>
		    </p>
		<?php endif; ?>
		<p>
		    <?= Html::a('Browse all Build Guides', ['/build-guide/index/', 'visibility_fk' => BuildGuide::VIS_PUBLIC], ['class' => 'btn btn-info']) ?>
		</p>
            </div>
	    
            <div class="col-lg-4">
                <h2>Parts Manager</h2>

                <p>
		    <?= Html::a('Add New CPU', ['/part/create/', 'role' => Role::CPU], ['class' => 'btn btn-success']) ?>
		    <?= Html::a('Add New Motherboard', ['/part/create/', 'role' => Role::MOTHERBOARD], ['class' => 'btn btn-success']) ?>
		</p>    
                <p>
		    <?= Html::a('Add New Memory', ['/part/create/', 'role' => Role::MEMORY], ['class' => 'btn btn-success']) ?>
		    <?= Html::a('Add New Storage', ['/part/create/', 'role' => Role::STORAGE], ['class' => 'btn btn-success']) ?>
		</p>    
                <p>
		    <?= Html::a('Add New Video Card', ['/part/create/', 'role' => Role::VIDEO_CARD], ['class' => 'btn btn-success']) ?>
		    <?= Html::a('Add New Case', ['/part/create/', 'role' => Role::PC_CASE], ['class' => 'btn btn-success']) ?>
		</p>    
		<p>
		    <?= Html::a('Add New PSU', ['/part/create', 'role' => Role::PSU], ['class' => 'btn btn-success']) ?>
		</p>
            </div>
	    
            <div class="col-lg-4">
                <h2>Parts in Stock</h2>

                <p>
		    <?= Html::a('See All CPU', ['/part/index/', 'role_fk' => Role::CPU], ['class' => 'btn btn-info']) ?>
		    <?= Html::a('See All Motherboard', ['/part/index/', 'role_fk' => Role::MOTHERBOARD], ['class' => 'btn btn-info']) ?>
		</p>    
                <p>
		    <?= Html::a('See All Memory', ['/part/index/', 'role_fk' => Role::MEMORY], ['class' => 'btn btn-info']) ?>
		    <?= Html::a('See All Storage', ['/part/index/', 'role_fk' => Role::STORAGE], ['class' => 'btn btn-info']) ?>
		</p>    
                <p>
		    <?= Html::a('See All Video Card', ['/part/index/', 'role_fk' => Role::VIDEO_CARD], ['class' => 'btn btn-info']) ?>
		    <?= Html::a('See All Case', ['/part/index/', 'role_fk' => Role::PC_CASE], ['class' => 'btn btn-info']) ?>
		</p>    
		<p>
		    <?= Html::a('See All PSU', ['/part/index', 'role_fk' => Role::PSU], ['class' => 'btn btn-info']) ?>
		</p>
		<p>
		    <?= Html::a('All Parts', ['/part/index', 'role_fk' => ''], ['class' => 'btn btn-info']) ?>
		</p>
            </div>
    
	    <div class="col-lg-4">
                <h2>Newest Announcement</h2>
		<?php if ($lastAnnounsment): ?>
		    <h4> <?= $lastAnnounsment->title ?> </h4>
		    <p> <?= StringHelper::truncate($lastAnnounsment->announcement, 150, ' .........') ?></p>
			<?php
			//NON Yii method
			/*
			if (strlen($lastAnnounsment->announcement) > 150) {
			    // truncate string
			    $stringCut = substr($lastAnnounsment->announcement, 0, 150);
			    // make sure it ends in a word so assassinate doesn't become ass...
			    $announcement = substr($stringCut, 0, strrpos($stringCut, ' ')) . ' .........';
			    echo '<p>' . $announcement . '</p>';
			} else {
			    echo '<p>' . $lastAnnounsment->announcement . '</p>';
			}
			*/
			?>
		    <p> Author: <?= $lastAnnounsment->userFk->username ?> --- Date: <?= $lastAnnounsment->announcement_date ?> </p>
		    <p>
			<?= Html::a('See this announcements', ['announcement/view', 'id' => $lastAnnounsment->announcement_id], ['class' => 'btn btn-info']) ?>
		    </p>
		<?php else: ?>
		    <p> <?= Html::encode('No announcements yet') ?> </p>
		<?php endif; ?>
                <p>
		    <?= Html::a('Add Announcement', ['/announcement/create'], ['class' => 'btn btn-success']) ?>
		    <?= Html::a('All Announcement', ['/announcement/index'], ['class' => 'btn btn-info']) ?>
		</p>
            </div>
	    <div class="col-lg-4">
                <h2>Orders</h2>
		<h4> <?= Html::encode('Their is ' . $newOrderCount . ' new orders pending') ?> </h4>
		    <p>
			<?= Html::a('New Orders', ['/order/index/', 'status_fk' => 1], ['class' => 'btn btn-success']) ?>

			<?= Html::a('All Orders', ['/order/index/'], ['class' => 'btn btn-info']) ?>
		    </p>
            </div>
	    <div class="col-lg-4">
                <h2>Tasks</h2>
		    <p>
			<?= Html::a('My Tasks', ['/task/index', 'assigned_to' => Yii::$app->user->identity->user_id], ['class' => 'btn btn-info']) ?>
			<?= Html::a('All Tasks', ['/task/index'], ['class' => 'btn btn-info']) ?>
		    </p>
            </div>
        </div>

    </div>
</div>
