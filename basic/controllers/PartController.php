<?php

namespace app\controllers;

use Yii;
use app\models\Part;
use app\models\PartSearch;

use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Manufacturer;
use app\models\Role;
use app\models\Parameter;
use app\models\Review;
use \app\models\BuildGuide;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PartController implements the CRUD actions for Part model.
 */
class PartController extends Controller
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
     * Lists all Part models.
     * @return mixed
     */
    public function actionIndex($role_fk, $build = NULL)
    {
        $searchModel = new PartSearch();
	if ($role_fk != Role::ANY) {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $role_fk);
	} else {
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	}
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
	    'build' => $build,
        ]);
    }

    /**
     * Displays a single Part model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $build = NULL)
    {
	$model = $this->findModel($id);
	$parameters = new ActiveDataProvider([
	    'query' => $model->getParameters(),
	    ]);
	if (!Yii::$app->user->isGuest) {
	    $userReview = Review::find()->where(['user_fk' => Yii::$app->user->identity->user_id])->andWhere(['part_fk' => $model->part_id])->one();
	} else {
	    $userReview = NULL;
	}
        return $this->render('view', [
            'model' => $model,
	    'parameters' => $parameters,
	    'review' => $userReview,
	    'build' => $build,
        ]);
    }

    /**
     * Creates a new Part model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($role)
    {
	if(Yii::$app->user->identity && (Yii::$app->user->identity->isAdmin() || Yii::$app->user->identity->isStaff())) {
	    
	    $model = new Part();
	    $manufacturers = ArrayHelper::map(Manufacturer::find()->all(), 'manufacturer_id', 'manufacturer_name');
	    $parametersData = $model->getParametersData($role);
	    $model->setAttribute('role_fk', $role);
	    $partRole = Role::find()->where(['role_id' => $role])->one();
	    if ($model->load(Yii::$app->request->post()) && $model->save()) {
		return $this->redirect(['view', 'id' => $model->part_id]);
	    } else {
		return $this->render('create', [
		    'model' => $model,
		    'manufacturers' => $manufacturers,
		    'role' => $partRole,
		    'parametersData' => $parametersData,
		]);
	    }
	    
	} else {
	    throw new \yii\web\HttpException(403, 'STAFF ONLY');
        }
    }
    /**
     * Updates an existing Part model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
	if(Yii::$app->user->identity && (Yii::$app->user->identity->isAdmin() || Yii::$app->user->identity->isStaff())) {
	    
	    $model = $this->findModel($id);
	    $manufacturers = ArrayHelper::map(Manufacturer::find()->all(), 'manufacturer_id', 'manufacturer_name');
	    $parametersData = $model->getParametersData($model->role_fk);
	    if ($model->load(Yii::$app->request->post()) && $model->save()) {
		return $this->redirect(['view', 'id' => $model->part_id]);
	    } else {
		return $this->render('update', [
		    'model' => $model,
		    'manufacturers' => $manufacturers,
		    'role' => $model->role_fk,
		    'parametersData' => $parametersData,
		]);
	    }
	    
	} else {
	    throw new \yii\web\HttpException(403, 'STAFF ONLY');
        }
    }

    /**
     * Deletes an existing Part model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
	if(Yii::$app->user->identity && (Yii::$app->user->identity->isAdmin() || Yii::$app->user->identity->isStaff())) {
	    
	    $this->findModel($id)->delete();
	    return $this->redirect(['index', 'role_fk' => '']);
	    
	} else {
	    throw new \yii\web\HttpException(403, 'STAFF ONLY');
        }
    }

    /**
     * Finds the Part model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Part the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Part::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

    public function actionLinkPart($build_id, $part_id)
    {
	$build = BuildGuide::find()->where(['build_guide_id' => $build_id])->one();
	$part = Part::find()->where(['part_id' => $part_id])->one();
	$part->link('builds', $build);
	return $this->redirect(['/build-guide/view', 'id' => $build_id]);
    }
    
} // END OF THE CONTROLLER