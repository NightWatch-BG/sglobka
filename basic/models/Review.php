<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property integer $review_id
 * @property integer $user_fk
 * @property integer $part_fk
 * @property string $review
 * @property integer $rating
 *
 * @property Part $partFk
 * @property User $userFk
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_fk', 'part_fk', 'rating'], 'required'],
            [['user_fk', 'part_fk', 'rating'], 'integer'],
            [['review'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'review_id' => 'Review ID',
            'user_fk' => 'User',
            'part_fk' => 'Part',
            'review' => 'Review',
            'rating' => 'Rating',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartFk()
    {
        return $this->hasOne(Part::className(), ['part_id' => 'part_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFk()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_fk']);
    }
    
    //**************************************************************************************************************************************************/
    public function afterSave($insert, $changedAttributes) {
	$part = $this->getPartFk()->one();
	$query  = Review::find()->where(['part_fk' => $this->part_fk]);
	$sum = $query->sum('rating');
	$count = $query->count();
	$part->overal_rating = $sum / $count;
	$part->updateAttributes(['overal_rating']);
	parent::afterSave($insert, $changedAttributes);
    }

} // END OF THE MODEL
