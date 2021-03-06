<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Sglobka',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
	['label' => 'Home', 'url' => ['/site/index']],
	['label' => 'Builds', 'url' => ['/build-guide/index', 'visibility_fk' => \app\models\BuildGuide::VIS_PUBLIC]],
	['label' => 'Parts', 'url' => ['/part/index']],
        /*
	* ['label' => 'About', 'url' => ['/site/about']],
	* ['label' => 'Contact', 'url' => ['/site/contact']],
	*/
	];
    if(!Yii::$app->user->isGuest) {
	if(yii::$app->user->identity->isAdmin()) {
	    $menuItems[] = ['label' => 'All Users', 'url' => ['/user/index']];
	}
	if(yii::$app->user->identity->isStaff()) {
	    $menuItems[] = ['label' => 'Orders', 'url' => ['/order/index']];
	}  
    }

    if(Yii::$app->user->isGuest) {
	$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
	$menuItems[] = ['label' => 'Register', 'url' => ['/user/create']];
    } else {
	$menuItems[] = ['label' => 'My Builds', 'url' => ['/build-guide/index/', 'user_fk' => Yii::$app->user->identity->user_id]];
	$menuItems[] = ['label' => 'Profile', 'url' => ['/user/view', 'id' => \Yii::$app->user->identity->user_id]];
	$menuItems[] = [
		'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
		'url' => ['/site/logout'],
		'linkOptions' => ['data-method' => 'post']
	    ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
