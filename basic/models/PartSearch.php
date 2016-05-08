<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Part;

/**
 * PartSearch represents the model behind the search form about `app\models\Part`.
 */
class PartSearch extends Part
{
    public function attributes()
    {
    // add related fields to searchable attributes
    return array_merge(parent::attributes(), ['manufacturerFk.manufacturer_name', 'roleFk.role']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['part_id', 'manufacturer_fk', 'role_fk', 'overal_rating'], 'integer'],
            [['name', 'part_number', 'model', 'more_info', 'manufacturerFk.manufacturer_name', 'roleFk.role'], 'safe'],
            [['price'], 'number'],
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
        $query = Part::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
	$query->joinWith('manufacturerFk AS manufacturerFk');
	$dataProvider->sort->attributes['manufacturerFk.manufacturer_name'] = [
	    'asc' => ['manufacturerFk.manufacturer_name' => SORT_ASC],
	    'desc' => ['manufacturerFk.manufacturer_name' => SORT_DESC],
	];
	$query->joinWith('roleFk AS roleFk');
	$dataProvider->sort->attributes['roleFk.role'] = [
	    'asc' => ['roleFk.role' => SORT_ASC],
	    'desc' => ['roleFk.role' => SORT_DESC],
	];
	
        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'part_id' => $this->part_id,
            'manufacturer_fk' => $this->manufacturer_fk,
            'role_fk' => $this->role_fk,
            'overal_rating' => $this->overal_rating,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'part_number', $this->part_number])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'more_info', $this->more_info]);

	$query->andFilterWhere(['like', 'manufacturerFk.manufacturer_name', $this->getAttribute('manufacturerFk.manufacturer_name')]);
	$query->andFilterWhere(['like', 'roleFk.role', $this->getAttribute('roleFk.role')]);

	
        return $dataProvider;
    }
}
