<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Announcement;

/**
 * AnnouncementSearch represents the model behind the search form about `app\models\Announcement`.
 */
class AnnouncementSearch extends Announcement
{
    public function attributes()
    {
    // add related fields to searchable attributes
    return array_merge(parent::attributes(), ['userFk.username']);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['announcement_id', 'user_fk'], 'integer'],
            [['title', 'announcement', 'announcement_date', 'userFk.username'], 'safe'],
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
        $query = Announcement::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
	$query->joinWith('userFk AS userFk');
	$dataProvider->sort->attributes['userFk.username'] = [
	    'asc' => ['userFk.username' => SORT_ASC],
	    'desc' => ['userFk.username' => SORT_DESC],
	];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'announcement_id' => $this->announcement_id,
            'user_fk' => $this->user_fk,
            'announcement_date' => $this->announcement_date,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'announcement', $this->announcement]);
	
	$query->andFilterWhere(['like', 'userFk.username', $this->getAttribute('userFk.username')]);

        return $dataProvider;
    }
}
