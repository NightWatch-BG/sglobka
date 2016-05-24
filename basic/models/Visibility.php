<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visibility".
 *
 * @property integer $visibility_id
 * @property string $visibility
 *
 * @property BuildGuide[] $buildGuides
 */
class Visibility extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visibility';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['visibility'], 'required'],
            [['visibility'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'visibility_id' => 'Visibility ID',
            'visibility' => 'Visibility',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildGuides()
    {
        return $this->hasMany(BuildGuide::className(), ['visibility_fk' => 'visibility_id']);
    }
}
