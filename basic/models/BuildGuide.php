<?php

namespace app\models;

use Yii;

use app\models\Role;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "build_guide".
 *
 * @property integer $build_guide_id
 * @property integer $user_fk
 * @property string $title
 * @property string $guide
 * @property integer $visibility_fk
 * @property string $last_update
 * @property integer $in_order
 *
 * @property User $userFk
 * @property Visibility $visibilityFk
 * @property BuildPart[] $buildParts
 * @property Order[] $orders
 */
class BuildGuide extends \yii\db\ActiveRecord
{
    const VIS_PUBLIC = 1;
    const VIS_PRIVATE = 2;
    const ORDERED = 1;
    const NOT_ODERED = 0;

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
            [['user_fk', 'visibility_fk'], 'required'],
            [['user_fk', 'visibility_fk', 'in_order'], 'integer'],
            [['last_update'], 'safe'],
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
            'user_fk' => 'User',
            'title' => 'Title',
            'guide' => 'Guide',
	    'visibility_fk' => 'Visibility',
	    'last_update' => 'Last Update',
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
    public function getParts()
    {
        return $this->hasMany(Part::className(), ['part_id' => 'part_fk'])->viaTable('build_part', ['build_guide_fk' => 'build_guide_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['build_fk' => 'build_guide_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getVisibilityFk() 
    { 
       return $this->hasOne(Visibility::className(), ['visibility_id' => 'visibility_fk']); 
    } 
//**************************************************************************************************************************************************/

    public static function getNewestBuildGuide() {
	$lastBuildGuide = BuildGuide::find()->where(['visibility_fk' => BuildGuide::VIS_PUBLIC])->orderBy('last_update DESC')->one();
	return $lastBuildGuide;
    }
    
    public static function getMyNewestBuild() {
	$lastBuildGuide = BuildGuide::find()->where(['user_fk' => Yii::$app->user->identity->user_id])->orderBy('last_update DESC')->one();
	return $lastBuildGuide;
    }
    
    public function getAddedParts() {
	$partsData = new ActiveDataProvider(['query' => $this->getParts(),]);
	$parts = [];
	foreach ($partsData->models as $part) {
	    switch ($part['role_fk']) {
		case Role::CPU: $parts['CPU'] = $part;
		    break;
		case Role::MOTHERBOARD: $parts['Motherboard'] = $part;
		    break;
		case Role::MEMORY: $parts['Memory'] = $part;
		    break;
		case Role::STORAGE: $parts['Storage'] = $part;
		    break;
		case Role::VIDEO_CARD: $parts['Video card'] = $part;
		    break;
		case Role::PC_CASE: $parts['Case'] = $part;
		    break;
		case Role::PSU: $parts['PSU'] = $part;
		    break;
	} }
	return $parts;
    }

//**************************************************************************************************************************************************/    
    /**
     * BEFORE SAVE
     */
    public function beforeSave($insert)
    {
	$this->validate();
	if (parent::beforeSave($insert)) {
	    $this->last_update = date("Y-m-d H:i:s");
	    
	    return true;
	} else {
	    return false;
	}
    }
    
//**************************************************************************************************************************************************/
} // END OF THE MODEL