<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
	$searchModel = new UserSearch();
	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	
	return $this->render('index', [
	    'searchModel' => $searchModel, 
	    'dataProvider' => $dataProvider,
	]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	$modelUser = $this->findModel($id);
	//$modelAddress = Yii::$app->user->identity->getAddressFk()->one();
        return $this->render('view', [
            'modelUser' => $modelUser,
	    //'modelAddress' => $modelAddress,
        ]);
    }

    public function actionNewUserData($id)
    {
	$modelUser = $this->findModel($id);
        return $this->render('newUserData', [
            'modelUser' => $modelUser,
        ]);
    }
    
    
    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();
	
	if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return  ActiveForm::validate($model);
        }
	if ($model->load(Yii::$app->request->post())) {
	    $model->setAttributes(array(
                'salt' => Yii::$app->security->generateRandomString(),
		'auth_key' => Yii::$app->security->generateRandomString(),
		'registration_date' => date("Y-m-d H:i:s"),
                'last_update' => date("Y-m-d H:i:s"),
		'user_type_fk' => User::USER_CLIENT,
                
            ));
	    if ($model->save()) {
		return $this->redirect(['new-user-data', 'id' => $model->user_id]);
	    }
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	
	if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('update', ['model' => $model,]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}// END OF THE CLASS
