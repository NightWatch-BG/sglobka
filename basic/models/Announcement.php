<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "announcement".
 *
 * @property integer $announcement_id
 * @property integer $user_fk
 * @property string $title
 * @property string $announcement
 * @property string $announcement_date
 *
 * @property User $userFk
 */
class Announcement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'announcement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_fk'], 'required'],
            [['user_fk'], 'integer'],
            [['announcement_date'], 'safe'],
            [['title'], 'string', 'max' => 45],
            [['announcement'], 'string', 'max' => 5000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'announcement_id' => 'Announcement ID',
            'user_fk' => 'User Fk',
            'title' => 'Title',
            'announcement' => 'Announcement',
            'announcement_date' => 'Date',
        ];
    }
//**************************************************************************************************************************************************/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFk()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_fk']);
    }  
//**************************************************************************************************************************************************/
    
    public function beforeSave($insert)
    {
	$this->validate();
	if (parent::beforeSave($insert)) {
	    $this->announcement_date = date("Y-m-d H:i:s");
	    return true;
	} else {
	    return false;
	}
    }
    
//**************************************************************************************************************************************************/

    public static function getNewestAnnounsment() {
	$lastAnnounsment = Announcement::find()->orderBy('announcement_date DESC')->one();
	return $lastAnnounsment;
    }
    
} // END OF THE CLASS