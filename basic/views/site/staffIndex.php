<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use app\models\Role;

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
                <h2>Newest Announcement</h2>
		<?php if ($lastAnnounsment): ?>
		    <h4> <?= $lastAnnounsment->title ?> </h4>
		    <p> <?= $lastAnnounsment->announcement ?> </p>
		    <p> Author: <?= $lastAnnounsment->userFk->username ?> --- Date: <?= $lastAnnounsment->announcement_date ?> </p>
		<?php else: ?>
		    <p> <?= Html::encode('No announcements yet') ?> </p>
		<?php endif; ?>
                <p>
		    <?= Html::a('Add Announcement', ['/announcement/create'], ['class' => 'btn btn-success']) ?>
		    <?= Html::a('All Announcement', ['/announcement/index'], ['class' => 'btn btn-info']) ?>
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
                <h2>Build your custom PC</h2>
		<?php if (!Yii::$app->user->isGuest): ?>
		    <p>
			<?= Html::a('Create a PC Build', ['/build-guide/create/'], ['class' => 'btn btn-success']) ?>
		    </p>
		<?php else: ?>
		    <p>
			<?= Html::encode('Login to start building!') ?>
		    </p>
		<?php endif; ?>
            </div>
        </div>

    </div>
</div>
