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
        <h1>SHOP!</h1>
        <p class="lead">View for the clients - by default and after login in client.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Build your custom PC</h2>
		<?php if (!Yii::$app->user->isGuest): ?>
    		<h4>My Newest Build</h4>
		    <?php if ($myBuild): ?>
			<h4> <?= $myBuild->title ?> </h4>
			<p> <?= StringHelper::truncate($myBuild->guide, 200, ' .........') ?></p>
			<p>
			    <?= Html::a('See this build', ['build-guide/view', 'id' => $lastBuildGuide->build_guide_id], ['class' => 'btn btn-info']) ?>
			</p>
		    <?php else: ?>
			<p> <?= Html::encode('No PC Builds yet') ?> </p>
		    <?php endif; ?>
    		<p>
		    <?= Html::a('Create a PC Build', ['/build-guide/create/'], ['class' => 'btn btn-success']) ?>
		    <?= Html::a('See my builds', ['/build-guide/index/', 'user_fk' => Yii::$app->user->identity->user_id], ['class' => 'btn btn-info']) ?>

    		</p>
		<?php else: ?>
		    <p>
			<?= Html::encode('Login to start building!') ?>
		    </p>
		    <?= Html::a('Login', ['/site/login'], ['class' => 'btn btn-primary']) ?>
		    <?= Html::a('Register', ['/user/create'], ['class' => 'btn btn-success']) ?>
		<?php endif; ?>
            </div>
            <div class="col-lg-4">
                <h2>User's Build Guides</h2>
		<h4>Newest Build Guide</h4>
		<?php if ($lastBuildGuide): ?>
		    <h4> <?= $lastBuildGuide->title ?> </h4>
		    <p> <?= StringHelper::truncate($lastBuildGuide->guide, 150, ' .........') ?></p>
		    <p> Author: <?= $lastBuildGuide->userFk->username ?></p>
		    <p>
			<?= Html::a('See this build', ['build-guide/view', 'id' => $lastBuildGuide->build_guide_id], ['class' => 'btn btn-info']) ?>
		    </p>
		<?php else: ?>
		    <p> <?= Html::encode('No PC Builds yet') ?> </p>
		<?php endif; ?>
		<p>
		    <?= Html::a('Browse all Build Guides', ['/build-guide/index/', 'visibility_fk' => BuildGuide::visibilityPublic], ['class' => 'btn btn-info']) ?>
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
     <?php  
// echo yii\helpers\Url::to(['part/view', 'id' => 1, 'build' => 3]);
// var_dump($build); 
     ?>
</div>
