<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "build_part".
 *
 * @property integer $build_part_id
 * @property integer $build_guide_fk
 * @property integer $part_fk
 *
 * @property BuildGuide $buildGuideFk
 * @property Part $partFk
 */
class BuildPart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'build_part';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['build_guide_fk', 'part_fk'], 'required'],
            [['build_guide_fk', 'part_fk'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'build_part_id' => 'Build Part ID',
            'build_guide_fk' => 'Build Guide Fk',
            'part_fk' => 'Part Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildGuideFk()
    {
        return $this->hasOne(BuildGuide::className(), ['build_guide_id' => 'build_guide_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartFk()
    {
        return $this->hasOne(Part::className(), ['part_id' => 'part_fk']);
    }
    
//**************************************************************************************************************************************************/    
} // END OF THE MODEL
