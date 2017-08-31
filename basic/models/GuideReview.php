<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "guide_review".
 *
 * @property integer $guide_review_id
 * @property integer $user_fk
 * @property integer $guide_fk
 * @property string $review
 * @property integer $rating
 *
 * @property BuildGuide $guideFk
 * @property User $userFk
 */
class GuideReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guide_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_fk', 'guide_fk', 'rating'], 'required'],
            [['user_fk', 'guide_fk', 'rating'], 'integer'],
            [['review'], 'string', 'max' => 5000],
            [['guide_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BuildGuide::className(), 'targetAttribute' => ['guide_fk' => 'build_guide_id']],
            [['user_fk'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_fk' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'guide_review_id' => 'Guide Review',
            'user_fk' => 'Author',
            'guide_fk' => 'Build Guide',
            'review' => 'Review',
            'rating' => 'Rating',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuideFk()
    {
        return $this->hasOne(BuildGuide::className(), ['build_guide_id' => 'guide_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFk()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_fk']);
    }
    
    public function beforeSave($insert)
    {
	$this->validate();
	if (parent::beforeSave($insert)) {
//	    $this->last_update = date("Y-m-d H:i:s");
	    
	    return true;
	} else {
	    return false;
	}
    }
}
