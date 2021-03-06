<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use \app\models\BuildGuide;
use \app\models\Announcement;
use \app\models\Order;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
	$lastBuildGuide = BuildGuide::getNewestBuildGuide();
	if (Yii::$app->user->identity) {
	    if (Yii::$app->user->identity->isStaff()) {
		$lastAnnounsment = Announcement::getNewestAnnounsment();
		$newOrderCount = Order::getNewOrders();
		return $this->render('staffIndex', [
			    'lastAnnounsment' => $lastAnnounsment,
			    'newOrderCount' => $newOrderCount,
		]);
	    } else {
		$myBuild = BuildGuide::getMyNewestBuild();
		return $this->render('index', [
			    'lastBuildGuide' => $lastBuildGuide,
			    'myBuild' => $myBuild,
		]);
	    }
	} else {
	    return $this->render('index', [
			'lastBuildGuide' => $lastBuildGuide,
			'myBuild' => NULL,
	    ]);
	}
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
/*
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
*/
}
