<?php

namespace app\controllers;

use Yii;
use app\models\Address;
use app\models\Visibility;
use app\models\BuildGuide;
use app\models\BuildGuideSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
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
    public function actionIndex($user_fk = 0, $visibility_fk = 0)
    {
	$searchModel = new BuildGuideSearch();
	if($user_fk) {
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $user_fk);	    
	} else {
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $visibility_fk);
	}
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
    public function actionView($id) {
	$model = $this->findModel($id);
	//$parts = $model->getAddedParts();
	$parts = new ActiveDataProvider(['query' => $model->getParts(), 'sort' =>false]);
	if (Yii::$app->user->identity && Yii::$app->user->identity->isCreator($model->user_fk)) {
	    $haveAddress = Yii::$app->user->identity->haveAddress();
	    return $this->render('viewForAuthor', [
			'model' => $this->findModel($id),
			'parts' => $parts,
			'haveAddress' => $haveAddress,
	    ]);
	} else {
	    return $this->render('view', [
			'build' => $this->findModel($id),
			'parts' => $parts,
	    ]);
	}
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
	$model->in_order = BuildGuide::NOT_ODERED;
	$visibility = ArrayHelper::map(Visibility::find()->all(), 'visibility_id', 'visibility');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->build_guide_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
		'visibility' => $visibility,
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
	$visibility = ArrayHelper::map(Visibility::find()->all(), 'visibility_id', 'visibility');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->build_guide_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
		'visibility' => $visibility,
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

        return $this->redirect(['index', 'user_fk' => Yii::$app->user->identity->user_id]);
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
