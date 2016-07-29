<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $address_id
 * @property integer $user_fk 
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property integer $country_fk
 * @property integer $city_fk
 * @property string $last_update
 *
 * @property City $cityFk
 * @property Country $countryFk
 * @property User $userFk
 */
class Address extends \yii\db\ActiveRecord
{
    private $_user = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'phone', 'address', 'country_fk', 'city_fk'], 'required'],
            [['user_fk', 'country_fk', 'city_fk'], 'integer'],
            [['last_update'], 'safe'],
            [['email'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'address_id' => 'Address ID',
	    'user_fk' => 'User Fk', 
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'country_fk' => 'Country',
            'city_fk' => 'City',
            'last_update' => 'Last Update',
        ];
    }
//**************************************************************************************************************************************************/   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCityFk()
    {
        return $this->hasOne(City::className(), ['city_id' => 'city_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountryFk()
    {
        return $this->hasOne(Country::className(), ['country_id' => 'country_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFk()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_fk']);
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
}// END OF THE MODEL
