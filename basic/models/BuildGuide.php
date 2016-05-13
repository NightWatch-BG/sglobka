<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "build_guide".
 *
 * @property integer $build_guide_id
 * @property integer $user_fk
 * @property string $title
 * @property string $guide
 *
 * @property User $userFk
 * @property BuildPart[] $buildParts
 * @property Order[] $orders
 */
class BuildGuide extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'build_guide';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_fk'], 'required'],
            [['user_fk'], 'integer'],
            [['title'], 'string', 'max' => 45],
            [['guide'], 'string', 'max' => 5000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'build_guide_id' => 'Build Guide ID',
            'user_fk' => 'User Fk',
            'title' => 'Title',
            'guide' => 'Guide',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFk()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildParts()
    {
        return $this->hasMany(BuildPart::className(), ['build_guide_fk' => 'build_guide_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['build_fk' => 'build_guide_id']);
    }
}
