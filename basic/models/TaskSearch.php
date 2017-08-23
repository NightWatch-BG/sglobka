<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Task;

/**
 * TaskSearch represents the model behind the search form about `app\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'status_fk', 'assigned_from', 'assigned_to'], 'integer'],
            [['title', 'description', 'due_date', 'last_update'], 'safe'],
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
        $query = Task::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
	$query->joinWith('assignedTo AS assignedTo');
	$dataProvider->sort->attributes['assignedTo.last_name'] = [
	    'asc' => ['assignedTo.last_name' => SORT_ASC],
	    'desc' => ['assignedTo.last_name' => SORT_DESC],
	];
	$query->joinWith('assignedFrom AS assignedFrom');
	$dataProvider->sort->attributes['assignedFrom.last_name'] = [
	    'asc' => ['assignedFrom.last_name' => SORT_ASC],
	    'desc' => ['assignedFrom.last_name' => SORT_DESC],
	];

        $this->load($params, '');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'task_id' => $this->task_id,
            'status_fk' => $this->status_fk,
            'due_date' => $this->due_date,
            'assigned_from' => $this->assigned_from,
            'assigned_to' => $this->assigned_to,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

	$query->andFilterWhere(['like', 'assignedTo.last_name', $this->getAttribute('assignedTo.last_name')]);
	$query->andFilterWhere(['like', 'assignedFrom.last_name', $this->getAttribute('assignedFrom.last_name')]);

        return $dataProvider;
    }
}
