<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $city_id
 * @property string $city
 * @property integer $country_fk
 *
 * @property Address[] $addresses
 * @property Country $countryFk
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'country_fk'], 'required'],
            [['country_fk'], 'integer'],
            [['city'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city_id' => 'City ID',
            'city' => 'City',
            'country_fk' => 'Country Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['city_fk' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryFk()
    {
        return $this->hasOne(Country::className(), ['country_id' => 'country_fk']);
    }
}
