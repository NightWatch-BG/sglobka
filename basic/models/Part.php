<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

use app\models\Parameter;
use app\models\BuildGuide;

/**
 * This is the model class for table "part".
 *
 * @property integer $part_id
 * @property string $name
 * @property string $part_number
 * @property string $model
 * @property integer $manufacturer_fk
 * @property integer $role_fk
 * @property integer $overal_rating
 * @property string $more_info
 * @property string $price
 *
 * @property BuildPart[] $buildParts
 * @property Manufacturer $manufacturerFk
 * @property Role $roleFk
 * @property PartParameter[] $partParameters
 * @property Review[] $reviews
 */
class Part extends \yii\db\ActiveRecord
{
    const cpuSocket =1;
    const cpuCores = 2;
    const mbFormFactor = 3;
    const mbChipset = 4;
    const ramSlots = 5;
    const ramMax = 6;
    const ramSpeed = 7;
    const ramType = 8;
    const ramSize = 9;
    const storageCapacity = 10;
    const storageType = 11;
    const storageInterface = 12;
    const storageFormFactor = 13;
    const vcChipset = 14;
    const vcVram = 15;
    const vcInterface = 16;
    const vcSliCrossfire = 17;
    const vcDisplayPorts = 18;
    const vcMiniDisplayPorts = 19;
    const vcHdmi = 20;
    const vcMiniHdmi = 21;
    const vcDvi = 22;
    const vcSlotsWidth = 23;
    const caseType = 24;
    const psuType = 25;
    const psuModular = 26;
    const psuEfficiency = 27;
    const psuWatts = 28;
    
    public $parameter_ids = array(
	'cpuSocket_id' => 0,
	'cpuCores_id' => 0,
	'mbFormFactor_id' => 0,
	'mbChipset_id' => 0,
	'ramSlots_id' => 0,
	'ramMax_id' => 0,
	'ramSpeed_id' => 0,
	'ramType_id' => 0,
	'ramSize_id' => 0,
	'storageCapacity_id' => 0,
	'storageType_id' => 0,
	'storageInterface_id' => 0,
	'storageFormFactor_id' => 0,
	'vcChipset_id' => 0,
	'vcVram_id' => 0,
	'vcInterface_id' => 0,
	'vcSliCrossfire_id' => 0,
	'vcDisplayPorts_id' => 0,
	'vcMiniDisplayPorts_id' => 0,
	'vcHdmi_id' => 0,
	'vcMiniHdmi_id' => 0,
	'vcDvi_id' => 0,
	'vcSlotsWidth_id' => 0,
	'caseType_id' => 0,
	'psuType_id' => 0,
	'psuModular_id' => 0,
	'psuEfficiency_id' => 0,
	'psuWatts_id' => 0,
	);
    
    public $case_mb_form_factor = [];
    public $mb_ram_speed = [];
    

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'part';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'part_number', 'manufacturer_fk', 'role_fk'], 'required'],
            [['manufacturer_fk', 'role_fk'], 'integer'],
            [['price', 'overal_rating'], 'number'],
            [['name', 'part_number', 'model'], 'string', 'max' => 45],
            [['more_info'], 'string', 'max' => 300],
	    [['parameter_ids', 'case_mb_form_factor', 'mb_ram_speed'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'part_id' => 'Part ID',
            'name' => 'Name',
            'part_number' => 'Part Number',
            'model' => 'Model',
            'manufacturer_fk' => 'Manufacturer ',
            'role_fk' => 'Part type',
            'overal_rating' => 'Overal Rating',
            'more_info' => 'More Info',
            'price' => 'Price',
        ];
    }

//**************************************************************************************************************************************************/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildParts()
    {
        return $this->hasMany(BuildPart::className(), ['part_fk' => 'part_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilds()
    {
        return $this->hasMany(BuildGuide::className(), ['build_guide_id' => 'build_guide_fk'])->viaTable('build_part', ['part_fk' => 'part_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturerFk()
    {
        return $this->hasOne(Manufacturer::className(), ['manufacturer_id' => 'manufacturer_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleFk()
    {
        return $this->hasOne(Role::className(), ['role_id' => 'role_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartParameters()
    {
        return $this->hasMany(PartParameter::className(), ['part_fk' => 'part_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameters()
    {
        return $this->hasMany(Parameter::className(), ['parameter_id' => 'parameter_fk'])->viaTable('part_parameter', ['part_fk' => 'part_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['part_fk' => 'part_id']);
    }

  //**************************************************************************************************************************************************/   
    public function beforeSave($insert)
    {
	$this->validate();
	if (parent::beforeSave($insert)) {
	    if ($this->case_mb_form_factor != []) {
		foreach ($this->case_mb_form_factor as $mbff_id) {
		    $this->linkParameter($mbff_id, $this->part_id);
		}
	    }
	    if ($this->mb_ram_speed != []) {
		foreach ($this->mb_ram_speed as $mbram_id) {
		    $this->linkParameter($mbram_id, $this->part_id);
		}
	    }
	    return true;
	} else {
	    return false;
	}
    }    
    
//**************************************************************************************************************************************************/
    public function afterSave($insert, $changedAttributes) {
	foreach ($this->parameter_ids as $parameter_id) {
	    if($parameter_id != 0){
		$this->linkParameter($parameter_id, $this->part_id);
	    }
	}
	parent::afterSave($insert, $changedAttributes);
    }
    
    public function linkParameter($parameter_id , $part_id) {
	$parameter = Parameter::find()->where(['parameter_id' => $parameter_id])->one();
	if (!(PartParameter::find()->where( [ 'part_fk' => $part_id, 'parameter_fk' => $parameter_id ] )->exists())) {
	    $this->link('parameters', $parameter);
	}
    }
//**************************************************************************************************************************************************/
    public function getParametersData($role) {
	$parametersData = [];
	switch ($role) {
	    case Role::CPU:
		$parametersData['cpuSockets'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::cpuSocket])->all(), 'parameter_id', 'parameter_value');
		$parametersData['cpuCores'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::cpuCores])->all(), 'parameter_id', 'parameter_value');
		break;
	    case Role::MOTHERBOARD:
		$parametersData['cpuSockets'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::cpuSocket])->all(), 'parameter_id', 'parameter_value');
		$parametersData['mbFormFactor'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::mbFormFactor])->all(), 'parameter_id', 'parameter_value');
		$parametersData['mbChipset'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::mbChipset])->all(), 'parameter_id', 'parameter_value');
		$parametersData['ramSlots'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::ramSlots])->all(), 'parameter_id', 'parameter_value');
		$parametersData['ramMax'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::ramMax])->all(), 'parameter_id', 'parameter_value');
		$parametersData['ramSpeed'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::ramSpeed])->all(), 'parameter_id', 'parameter_value');
		$parametersData['ramType'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::ramType])->all(), 'parameter_id', 'parameter_value');
		break;
	    case Role::MEMORY:
		$parametersData['ramSize'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::ramSize])->all(), 'parameter_id', 'parameter_value');
		$parametersData['ramSpeed'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::ramSpeed])->all(), 'parameter_id', 'parameter_value');
		$parametersData['ramType'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::ramType])->all(), 'parameter_id', 'parameter_value');
		break;
	    case Role::STORAGE:
		$parametersData['storageCapacity'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::storageCapacity])->all(), 'parameter_id', 'parameter_value');
		$parametersData['storageType'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::storageType])->all(), 'parameter_id', 'parameter_value');
		$parametersData['storageInterface'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::storageInterface])->all(), 'parameter_id', 'parameter_value');
		$parametersData['storageFormFactor'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::storageFormFactor])->all(), 'parameter_id', 'parameter_value');
		break;
	    case Role::VIDEO_CARD:
		$parametersData['vcChipset'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::vcChipset])->all(), 'parameter_id', 'parameter_value');
		$parametersData['vcVram'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::vcVram])->all(), 'parameter_id', 'parameter_value');
		$parametersData['vcInterface'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::vcInterface])->all(), 'parameter_id', 'parameter_value');
		$parametersData['vcSliCrossfire'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::vcSliCrossfire])->all(), 'parameter_id', 'parameter_value');
		$parametersData['vcDisplayPorts'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::vcDisplayPorts])->all(), 'parameter_id', 'parameter_value');
		$parametersData['vcMiniDisplayPorts'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::vcMiniDisplayPorts])->all(), 'parameter_id', 'parameter_value');
		$parametersData['vcHdmi'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::vcHdmi])->all(), 'parameter_id', 'parameter_value');
		$parametersData['vcMiniHdmi'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::vcMiniHdmi])->all(), 'parameter_id', 'parameter_value');
		$parametersData['vcDvi'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::vcDvi])->all(), 'parameter_id', 'parameter_value');
		$parametersData['vcSlotsWidth'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::vcSlotsWidth])->all(), 'parameter_id', 'parameter_value');
		break;
	    case Role::PC_CASE:
		$parametersData['mbFormFactor'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::mbFormFactor])->all(), 'parameter_id', 'parameter_value');
		$parametersData['caseType'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::caseType])->all(), 'parameter_id', 'parameter_value');
		break;
	    case Role::PSU:
		$parametersData['psuType'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::psuType])->all(), 'parameter_id', 'parameter_value');
		$parametersData['psuModular'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::psuModular])->all(), 'parameter_id', 'parameter_value');
		$parametersData['psuEfficiency'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::psuEfficiency])->all(), 'parameter_id', 'parameter_value');
		$parametersData['psuWatts'] = ArrayHelper::map(Parameter::find()->where(['parameter_name_fk' => Part::psuWatts])->all(), 'parameter_id', 'parameter_value');
		break;
	}
	//$parametersData = array ("Sockets" => $cpuSockets, "Cores" => $cpuCores);
	return $parametersData;
    } 
} // END OF THE MODEL
