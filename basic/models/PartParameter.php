<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "part_parameter".
 *
 * @property integer $part_parameter_id
 * @property integer $part_fk
 * @property integer $parameter_fk
 *
 * @property Parameter $parameterFk
 * @property Part $partFk
 */
class PartParameter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'part_parameter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['part_fk', 'parameter_fk'], 'required'],
            [['part_fk', 'parameter_fk'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'part_parameter_id' => 'Part Parameter ID',
            'part_fk' => 'Part Fk',
            'parameter_fk' => 'Parameter Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameterFk()
    {
        return $this->hasOne(Parameter::className(), ['parameter_id' => 'parameter_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartFk()
    {
        return $this->hasOne(Part::className(), ['part_id' => 'part_fk']);
    }
}
