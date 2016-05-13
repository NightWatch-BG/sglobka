<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BuildGuide;

/**
 * BuildGuideSearch represents the model behind the search form about `app\models\BuildGuide`.
 */
class BuildGuideSearch extends BuildGuide
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['build_guide_id', 'user_fk'], 'integer'],
            [['title', 'guide'], 'safe'],
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
        $query = BuildGuide::find();

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
            'build_guide_id' => $this->build_guide_id,
            'user_fk' => $this->user_fk,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'guide', $this->guide]);

        return $dataProvider;
    }
}
