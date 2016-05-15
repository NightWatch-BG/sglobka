<?php

namespace app\controllers;

use Yii;
use app\models\Role;
use app\models\BuildGuide;
use app\models\BuildGuideSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;

/**
 * BuildGuideController implements the CRUD actions for BuildGuide model.
 */
class BuildGuideController extends Controller
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
     * Lists all BuildGuide models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BuildGuideSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BuildGuide model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	$model = $this->findModel($id);
	$partsData = new ActiveDataProvider([
	    'query' => $model->getParts(),
	    'key' => function ($model) {
		return $model->roleFk->role;
	    }
	    ]);
	foreach ($partsData->models as $part) {
	    switch ($part['role_fk']) {
		case Role::CPU:
		    $parts['CPU'] = $part;
		    break;
		case Role::MOTHERBOARD:
		    $parts['Motherboard'] = $part;
		    break;
		case Role::MEMORY:
		    $parts['Memory'] = $part;
		    break;
		case Role::STORAGE:
		    $parts['Storage'] = $part;
		    break;
		case Role::VIDEO_CARD:
		    $parts['Video card'] = $part;
		    break;
		case Role::PC_CASE:
		    $parts['Case'] = $part;
		    break;
		case Role::PSU:
		    $parts['PSU'] = $part;
		    break;
	    }
	}
        return $this->render('view', [
            'model' => $this->findModel($id),
	    'parts' => $parts,
        ]);
    }

    /**
     * Creates a new BuildGuide model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BuildGuide();
	$model->user_fk = Yii::$app->user->identity->user_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->build_guide_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BuildGuide model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->build_guide_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BuildGuide model.
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
     * Finds the BuildGuide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BuildGuide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BuildGuide::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
