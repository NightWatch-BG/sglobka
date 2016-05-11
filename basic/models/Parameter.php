<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parameter".
 *
 * @property integer $parameter_id
 * @property integer $parameter_name_fk
 * @property string $parameter_value
 *
 * @property ParameterName $parameterNameFk
 * @property PartParameter[] $partParameters
 */
class Parameter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parameter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parameter_name_fk', 'parameter_value'], 'required'],
            [['parameter_name_fk'], 'integer'],
            [['parameter_value'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parameter_id' => 'Parameter ID',
            'parameter_name_fk' => 'Parameter Name',
            'parameter_value' => 'Parameter Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameterNameFk()
    {
        return $this->hasOne(ParameterName::className(), ['parameter_name_id' => 'parameter_name_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartParameters()
    {
        return $this->hasMany(PartParameter::className(), ['parameter_fk' => 'parameter_id']);
    }
    
    public function getParts()
    {
        return $this->hasMany(Part::className(), ['parameter_fk' => 'parameter_id'])->viaTable('part_parameter', ['part_fk' => 'part_id']);
    }
}
