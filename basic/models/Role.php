<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $role_id
 * @property string $role
 *
 * @property Part[] $parts
 */
class Role extends \yii\db\ActiveRecord
{
    const ANY = 0;
    const CPU = 1;
    const MOTHERBOARD = 2;
    const MEMORY = 3;
    const STORAGE = 4;
    const VIDEO_CARD = 5;
    const PC_CASE = 6;
    const PSU = 7;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role'], 'required'],
            [['role'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'role' => 'Role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParts()
    {
        return $this->hasMany(Part::className(), ['role_fk' => 'role_id']);
    }
    
    public static function rolesArrayBuilder() {
	$roles = Role::find()->all();
	$rolesIndex = [];
	foreach ($roles as $id => $role){
	    $rolesIndex[$role->role] = $id+1;
	}
	return $rolesIndex;
    }
} // END OF THE MODEL
