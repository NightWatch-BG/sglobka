<?php

namespace app\models;

use Yii;

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
            [['manufacturer_fk', 'role_fk', 'overal_rating'], 'integer'],
            [['price'], 'number'],
            [['name', 'part_number', 'model'], 'string', 'max' => 45],
            [['more_info'], 'string', 'max' => 300]
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
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['part_fk' => 'part_id']);
    }
    
} // END OF THE MODEL
