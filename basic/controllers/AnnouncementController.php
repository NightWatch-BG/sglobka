<?php

namespace app\controllers;

use Yii;
use app\models\Announcement;
use app\models\AnnouncementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;

/**
 * AnnouncementController implements the CRUD actions for Announcement model.
 */
class AnnouncementController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Announcement models.
     * @return mixed
     */
    public function actionIndex()
    {
	if (Yii::$app->user->identity && Yii::$app->user->identity->isStaff()) {
	    $searchModel = new AnnouncementSearch();
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	    return $this->render('index', [
		'searchModel' => $searchModel,
		'dataProvider' => $dataProvider,
	    ]);
	} else {
	    throw new HttpException(403, 'STAFF ONLY');
	}
    }

    /**
     * Displays a single Announcement model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	if (Yii::$app->user->identity && Yii::$app->user->identitiy->isStaff()) {
	    return $this->render('view', [
		'model' => $this->findModel($id),
	    ]);
	} else {
	    throw new HttpException(403, 'STAFF ONLY');
	}
    }

    /**
     * Creates a new Announcement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
	if (Yii::$app->user->identity && Yii::$app->user->identity->isStaff()) {
	    $model = new Announcement();
	    if ($model->load(Yii::$app->request->post())) {
		$model->setAttributes(array(
		    'user_fk' => Yii::$app->user->identity->user_id,
		    //'announcement_date' => date("Y-m-d H:i:s"),
		));
	    }
	    if ($model->save()) {
		return $this->redirect(['view', 'id' => $model->announcement_id]);
	    } else {
		return $this->render('create', [
		    'model' => $model,
		]);
	    }
        } else {
	    throw new HttpException(403, 'STAFF ONLY');
	}
    }

    /**
     * Updates an existing Announcement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
	if (Yii::$app->user->identity && Yii::$app->user->identity->isStaff()) {
	    $model = $this->findModel($id);
	    if ($model->load(Yii::$app->request->post()) && $model->save()) {
		return $this->redirect(['view', 'id' => $model->announcement_id]);
	    } else {
		return $this->render('update', [
		    'model' => $model,
		]);
	    }
	} else {
	    throw new HttpException(403, 'STAFF ONLY');
	}
    }

    /**
     * Deletes an existing Announcement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
	if (Yii::$app->user->identity && Yii::$app->user->identity->isStaff()) {
	    $this->findModel($id)->delete();

	    return $this->redirect(['index']);
	} else {
	    throw new HttpException(403, 'STAFF ONLY');
	}
    }

    /**
     * Finds the Announcement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Announcement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Announcement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
//**************************************************************************************************************************************************/
} // END OF THE CONTROLLER
