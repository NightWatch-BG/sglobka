<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parameter_name".
 *
 * @property integer $parameter_name_id
 * @property string $parameter_name
 *
 * @property Parameter[] $parameters
 */
class ParameterName extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parameter_name';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parameter_name'], 'required'],
            [['parameter_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parameter_name_id' => 'Parameter Name ID',
            'parameter_name' => 'Parameter Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameters()
    {
        return $this->hasMany(Parameter::className(), ['parameter_name_fk' => 'parameter_name_id']);
    }
}
