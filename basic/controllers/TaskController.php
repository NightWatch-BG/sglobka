<?php

namespace app\controllers;

use Yii;
use app\models\Task;
use app\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;

use app\models\User;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
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
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex($assigned_to = 0)
    {
	if (Yii::$app->user->identity && Yii::$app->user->identity->isStaff()) {
	    $searchModel = new TaskSearch();
	    if ($assigned_to) {
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams, $assigned_to);
	    } else {
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	    }

	    $status = Task::getStatus();

	    return $this->render('index', [
		'searchModel' => $searchModel,
		'dataProvider' => $dataProvider,
		'status' => $status,
	    ]);
	} else {
	    throw new HttpException(403, 'STAFF ONLY');
	}
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	if (Yii::$app->user->identity && Yii::$app->user->identity->isStaff()) {
	    $model = $this->findModel($id);
	    $author = $model->getAssignedFrom($model['assigned_to'])->one();
	    $assignee = $model->getAssignedTo($model['assigned_to'])->one();
	    $status = $model->getStatus();
	    return $this->render('view', [
		'model' => $model,
		'author' => $author['first_name'] . ' ' . $author['last_name'],
		'assignee' => $assignee['first_name'] . ' ' . $assignee['last_name'],
		'status' => $status[$model['status_fk']],
	    ]);
	} else {
	    throw new HttpException(403, 'STAFF ONLY');
	}
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
	if (Yii::$app->user->identity && Yii::$app->user->identity->isStaff()) {
        $model = new Task();

	$staff = User::find()->where(['user_type_fk' => [User::USER_ADMIN, User::USER_STAFF]])->all();
	$assignees = [];
//	$assignees = [0 => 'Assign to:'];
	foreach ($staff as $value) {
	    $assignees[$value['user_id']] = $value['first_name'] . ' ' . $value['last_name'];
	}
	$status = $model->getStatus();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    
            return $this->redirect(['view', 'id' => $model->task_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
		'assignees' => $assignees,
		'status' => $status,
            ]);
        }
	} else {
	    throw new HttpException(403, 'STAFF ONLY');
	}
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
	if (Yii::$app->user->identity && Yii::$app->user->identity->isStaff()) {
        $model = $this->findModel($id);
	
	$staff = User::find()->where(['user_type_fk' => [User::USER_ADMIN, User::USER_STAFF]])->all();
	$assignees = [];
//	$assignees = [0 => 'Assign to:'];
	foreach ($staff as $value) {
	    $assignees[$value['user_id']] = $value['first_name'] . ' ' . $value['last_name'];
	}
	$status = $model->getStatus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->task_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
		'assignees' => $assignees,
		'status' => $status,
            ]);
        }
	} else {
	    throw new HttpException(403, 'STAFF ONLY');
	}
    }

    /**
     * Deletes an existing Task model.
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
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
