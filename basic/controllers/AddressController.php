<?php

namespace app\controllers;

use Yii;
use app\models\Address;
use app\models\AddressSearch;

use app\models\Country;
use app\models\City;
use yii\helpers\ArrayHelper;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AddressController implements the CRUD actions for Address model.
 */
class AddressController extends Controller
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
     * Lists all Address models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AddressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Address model.
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
     * Creates a new Address model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Address();
	$countries = ArrayHelper::map(Country::find()->all(), 'country_id', 'country');
	$cities = ArrayHelper::map( City::find()->all(), 'city_id', 'city');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    //$user = $model->getUser(Yii::$app->user->identity->username);
	    //$user->updateAttributes(['address_fk'=>$model->address_id]);
            return $this->redirect(['view', 'id' => $model->address_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
		'countries' => $countries,
		'cities' => $cities,
            ]);
        }
    }

    /**
     * Updates an existing Address model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $countries = ArrayHelper::map(Country::find()->all(), 'country_id', 'country');
	$cities = ArrayHelper::map( City::find()->all(), 'city_id', 'city');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->address_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'countries' => $countries,
		'cities' => $cities,
            ]);
        }
    }

    /**
     * Deletes an existing Address model.
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
     * Finds the Address model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Address the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Address::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    public function actionLists($id)
    {
	$countCities = City::find()
		->where(['country_fk' => $id])
		->count();
	if ($countCities > 0) {
	    
	    $cities = City::find()
		    ->where(['country_fk' => $id])
		    ->all();
	    foreach ($cities as $city) {
		echo "<option value='" .$city->city_id."'>" .$city->city."</option>";
	    }
	    
	    /*
	    $cities = ArrayHelper::map( City::find()->where(['country_fk' => $id])->all(), 'city_id', 'city');
	    return $this->render('create', [
                'model' => $model,
		'countries' => $countries,
		'cities' => $cities,
		]);
	    */
	} else {
	    echo "<option value=0> - </option>";
	}
    }
    
}// END OF THE CLASS
