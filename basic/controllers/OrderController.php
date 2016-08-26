<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

use app\models\Status;
use yii\helpers\ArrayHelper;
/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex($status_fk =0, $customer_fk = 0)
    {
        $searchModel = new OrderSearch();
	if ($status_fk) {
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $status_fk);
	} elseif ($customer_fk){
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $customer_fk);
	} else {
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	}
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	$order = $this->findModel($id);
	if(Yii::$app->user->identity->isStaff() && $order->status_fk == Order::STAT_PENDING) {
	    $order->status_fk = Order::STAT_RECEIVED;
	    $order->staff_fk = Yii::$app->user->identity->user_id;
	    $order->update();
	}
	$address = $this->getAddress($order->customer_fk);
	$build = $order->getBuildFk()->one();
	$parts = new ActiveDataProvider(['query' => $build->getParts(), 'sort' => false, 'key' => 'role_fk']);
        return $this->render('view', [
            'model' => $order,
	    'parts' =>$parts,
	    'address' => $address,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($build_id) {
        $model = new Order();
	$model->build_fk = $build_id;
	$build = $model->getBuildFk()->one();
	//$build2 = $this->findBuild($build_id);
	$parts = new ActiveDataProvider(['query' => $build->getParts(), 'sort' =>false]);
	$address = $this->getAddress($build->user_fk);
	
	//$model->build_fk = $build->build_guide_id;
	$model->customer_fk = $build->user_fk;
	$model->status_fk = Order::STAT_PENDING;
	$model->date_of_order = date("Y-m-d H:i:s");
	
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
		'build' => $build,
		'parts' => $parts,
		'address' => $address,		
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	$status = ArrayHelper::map(Status::find()->all(), 'status_id', 'status');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
		'status' => $status,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    //Currently not in use!!! Needed BuildGuide is found through Order::getBuildFk()
    /*
    protected function findBuild($build_id)
    {
        if (($model = \app\models\BuildGuide::findOne($build_id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    */
    
    protected function getAddress($user_id)
    {
        if (($model = \app\models\Address::findOne(['user_fk' => $user_id])) !== null) {
	    return $model;
            //return $model->countryFk->country .', ' . $model->cityFk->city .', ' . $model->address;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
//**************************************************************************************************************************************************/
} // END OF THE CONTROLLER
