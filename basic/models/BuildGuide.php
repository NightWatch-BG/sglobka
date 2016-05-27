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
 *
 * @property User $userFk
 * @property Visibility $visibilityFk 
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
            [['user_fk', 'visibility_fk'], 'required'],
            [['user_fk', 'visibility_fk'], 'integer'],
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
	$lastBuildGuide = BuildGuide::find()->orderBy('build_guide_id DESC')->one();
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

} // END OF THE MODEL