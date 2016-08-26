<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{
    public function attributes()
    {
    // add related fields to searchable attributes
    return array_merge(parent::attributes(), ['statusFk.status', 'customerFk.username']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'customer_fk', 'staff_fk', 'build_fk', 'status_fk'], 'integer'],
            [['notes', 'staff_notes', 'date_of_order', 'last_update', 'statusFk.status', 'customerFk.username'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

	$query->joinWith('statusFk AS statusFk');
	$dataProvider->sort->attributes['statusFk.status'] = [
	    'asc' => ['statusFk.status' => SORT_ASC],
	    'desc' => ['statusFk.status' => SORT_DESC],
	];
	$query->joinWith('customerFk AS customerFk');
	$dataProvider->sort->attributes['customerFk.username'] = [
	    'asc' => ['customerFk.username' => SORT_ASC],
	    'desc' => ['customerFk.username' => SORT_DESC],
	];
	
        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'order_id' => $this->order_id,
            'customer_fk' => $this->customer_fk,
            'staff_fk' => $this->staff_fk,
            'build_fk' => $this->build_fk,
            'status_fk' => $this->status_fk,
            'date_of_order' => $this->date_of_order,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'staff_notes', $this->staff_notes]);

        $query->andFilterWhere(['like', 'statusFk.status', $this->getAttribute('statusFk.status')]);
        $query->andFilterWhere(['like', 'customerFk.username', $this->getAttribute('customerFk.username')]);

        return $dataProvider;
    }
}
