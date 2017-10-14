<?php

namespace app\controllers;

use Yii;
use app\models\Visibility;
use app\models\BuildGuide;
use app\models\Role;
use app\models\BuildGuideSearch;
use app\models\GuideReview;
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
	$parts = new ActiveDataProvider(['query' => $model->getParts(), 'sort' => false, 'key' => 'role_fk']);
	if (Yii::$app->user->identity && Yii::$app->user->identity->isCreator($model->user_fk)) { // && !$model->in_order) {
	    $haveAddress = Yii::$app->user->identity->haveAddress();
	    $roles = Role::rolesArrayBuilder();
	    if($model->in_order) {
		Yii::$app->session->remove('build_id');
	    } else {
		Yii::$app->session->set('build_id', $model->build_guide_id);
	    }
	    return $this->render('viewForAuthor', [
			'build' => $model,
			'parts' => $parts,
			'haveAddress' => $haveAddress,
			'roles' => $roles,
	    ]);
	} else {
	    if (!Yii::$app->user->isGuest) {
		$review = GuideReview::find()->where(['user_fk' => Yii::$app->user->identity->user_id])->andWhere(['guide_fk' => $model->build_guide_id])->one();
	    } else {
		$review = false;
	    }
	    return $this->render('view', [
			'model' => $model,
			'parts' => $parts,
			'review' => $review,
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
	$model->avr_rating = 0;
	$model->ratings_count = BuildGuide::NOT_ODERED;
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
//**************************************************************************************************************************************************/
} // END OF THE CONTROLLER