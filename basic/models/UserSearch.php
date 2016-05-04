<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    public function attributes()
    {
    // add related fields to searchable attributes
    return array_merge(parent::attributes(), ['userTypeFk.user_type']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_type_fk'], 'integer'],
            [['username', 'first_name', 'last_name', 'password', 'salt', 'auth_key', 'registration_date', 'last_update', 'userTypeFk.user_type'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
	$query->joinWith('userTypeFk AS userTypeFk');
	$dataProvider->sort->attributes['userTypeFk.user_type'] = [
	    'asc' => ['userTypeFk.user_type' => SORT_ASC],
	    'desc' => ['userTypeFk.user_type' => SORT_DESC],
	];
	
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'registration_date' => $this->registration_date,
            'user_type_fk' => $this->user_type_fk,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'salt', $this->salt])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key]);
	
	$query->andFilterWhere(['like', 'userTypeFk.user_type', $this->getAttribute('userTypeFk.user_type')]);

        return $dataProvider;
    }
}
