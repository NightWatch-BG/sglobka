<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GuideReview;

/**
 * GuideReviewSearch represents the model behind the search form about `app\models\GuideReview`.
 */
class GuideReviewSearch extends GuideReview
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['guide_review_id', 'user_fk', 'guide_fk', 'rating'], 'integer'],
            [['review'], 'safe'],
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
        $query = GuideReview::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'guide_review_id' => $this->guide_review_id,
            'user_fk' => $this->user_fk,
            'guide_fk' => $this->guide_fk,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'review', $this->review]);

        return $dataProvider;
    }
}
