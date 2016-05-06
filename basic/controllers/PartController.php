<?php

namespace app\controllers;

use Yii;
use app\models\Part;
use app\models\PartSearch;

use app\models\Manufacturer;
use app\models\Role;
use yii\helpers\ArrayHelper;

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
    public function actionIndex()
    {
        $searchModel = new PartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Part model.
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
     * Creates a new Part model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($role)
    {
        $model = new Part();
	$manufacturers = ArrayHelper::map(Manufacturer::find()->all(), 'manufacturer_id', 'manufacturer_name');
	if ($role != Role::ANY) {
	    $roles = ArrayHelper::map(Role::find()->where(['role_id' => $role])->all(), 'role_id', 'role');
	} else {
	    $roles = ArrayHelper::map(Role::find()->all(), 'role_id', 'role');
	}
	
	

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->part_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
		'manufacturers' => $manufacturers,
		'roles' => $roles,
            ]);
        }
    }

    /**
     * Updates an existing Part model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	$manufacturers = ArrayHelper::map(Manufacturer::find()->all(), 'manufacturer_id', 'manufacturer_name');
	$roles = ArrayHelper::map(Role::find()->all(), 'role_id', 'role');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->part_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
		'manufacturers' => $manufacturers,
		'roles' => $roles,
            ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
    
} // END OF THE CONTROLLER