<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use app\models\Role;

$this->title = 'Sglobka - Custom Personal Computer Systems';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>SHOP!</h1>
        <p class="lead">View to show by default and after loged in client.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Button image to create a build</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Button image to look at build guides</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
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
        </div>

    </div>
</div>
