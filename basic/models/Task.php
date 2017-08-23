<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $task_id
 * @property string $title
 * @property string $description
 * @property integer $status_fk
 * @property string $due_date
 * @property integer $assigned_from
 * @property integer $assigned_to
 * @property string $last_update
 *
 * @property User $assignedTo
 * @property User $assignedFrom
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'status_fk'], 'required'],
            [['status_fk', 'assigned_from', 'assigned_to'], 'integer'],
            [['due_date', 'last_update'], 'safe'],
            [['title'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 5000],
            [['assigned_to'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['assigned_to' => 'user_id']],
            [['assigned_from'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['assigned_from' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task',
            'title' => 'Title',
            'description' => 'Description',
            'status_fk' => 'Status',
            'due_date' => 'Due Date',
            'assigned_from' => 'Author',
            'assigned_to' => 'Assignee',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedTo()
    {
        return $this->hasOne(User::className(), ['user_id' => 'assigned_to']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedFrom()
    {
        return $this->hasOne(User::className(), ['user_id' => 'assigned_from']);
    }
    
    public static function getStatus()
    {
	return $list = [
	    1 => 'New',
	    2 => 'Assigned',
	    3 => 'In progress',
	    4 => 'Done',
	];
    }
    
    public function statusForIndex($data) 
    {
	$list = $this->getStatus();
	return $list[$data];
    }
    
    public function beforeSave($insert)
    {
	$this->assigned_from = Yii::$app->user->identity->user_id;
	$this->validate();
	if (parent::beforeSave($insert)) {
	    $this->last_update = date("Y-m-d H:i:s");
	    return true;
	} else {
	    return false;
	}
    }
    
    public function isInTeam($user_id) 
    {
	return $user_id == $this->assigned_from || $user_id == $this->assigned_to;
    }
}
