<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PartParameter;

/**
 * PartParameterSearch represents the model behind the search form about `app\models\PartParameter`.
 */
class PartParameterSearch extends PartParameter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['part_parameter_id', 'part_fk', 'parameter_fk'], 'integer'],
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
        $query = PartParameter::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'part_parameter_id' => $this->part_parameter_id,
            'part_fk' => $this->part_fk,
            'parameter_fk' => $this->parameter_fk,
        ]);

        return $dataProvider;
    }
}
