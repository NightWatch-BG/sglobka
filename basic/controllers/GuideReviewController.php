<?php

namespace app\controllers;

use Yii;
use app\models\BuildGuide;
use app\models\GuideReview;
use app\models\GuideReviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GuideReviewController implements the CRUD actions for GuideReview model.
 */
class GuideReviewController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all GuideReview models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GuideReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GuideReview model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GuideReview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($build)
    {
	if (!Yii::$app->user->isGuest) {
	    $model = new GuideReview();
	    $model->user_fk = Yii::$app->user->identity->user_id;
	    $model->guide_fk = $build;

	    if ($model->load(Yii::$app->request->post()) && $model->save()) {
		return $this->redirect(['view', 'id' => $model->guide_review_id]);
	    } else {
		return $this->render('create', [
		    'model' => $model,
		]);
	    }
	} else {
	    return $this->redirect('/build-guide/index?visibility_fk=' . BuildGuide::VIS_PUBLIC);
	}
    }

    /**
     * Updates an existing GuideReview model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->guide_review_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GuideReview model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GuideReview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GuideReview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GuideReview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
