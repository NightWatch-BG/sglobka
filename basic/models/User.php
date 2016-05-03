<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $salt
 * @property string $auth_key
 * @property string $registration_date
 * @property integer $user_type_fk
 * @property string $last_update
 *
 * @property Address[] $addresses 
 * @property Announcement[] $announcements
 * @property BuildGuide[] $buildGuides
 * @property Messages[] $messages
 * @property Messages[] $messages0
 * @property Order[] $orders
 * @property Order[] $orders0
 * @property Review[] $reviews
 * @property UserType $userTypeFk
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const USER_ADMIN = 1;
    const USER_STAFF= 2;
    const USER_CLIENT = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
	    ['username', 'filter', 'filter' => 'trim'],
            [['registration_date', 'last_update'], 'safe'],
            [['user_type_fk'], 'integer'],
            [['username'], 'string', 'min' => 2, 'max' => 16],
            [['first_name', 'last_name'], 'string', 'min' => 2, 'max' => 45],
            [['password', 'salt', 'auth_key'], 'string', 'max' => 64],
	    ['password', 'string', 'min' => 6],
            [['username'], 'unique', 'targetAttribute' => ['username'], 'message' => 'This username has already been taken.'],
            [['auth_key'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'password' => 'Password',
            'salt' => 'Salt',
            'auth_key' => 'Auth Key',
            'registration_date' => 'Registration Date',
            'user_type_fk' => 'User Type',
            'last_update' => 'Last Update',
        ];
    }

//**************************************************************************************************************************************************/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncements()
    {
        return $this->hasMany(Announcement::className(), ['user_fk' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildGuides()
    {
        return $this->hasMany(BuildGuide::className(), ['user_fk' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['author_fk' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages0()
    {
        return $this->hasMany(Messages::className(), ['receiver_fk' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_fk' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Order::className(), ['staff_fk' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['user_fk' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
	return $this->hasMany(Address::className(), ['user_fk' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTypeFk()
    {
        return $this->hasOne(UserType::className(), ['user_type_id' => 'user_type_fk']);
    }
//**************************************************************************************************************************************************/
// Implementatiom of the IdentityInterface methods
//**************************************************************************************************************************************************/
    /**
     * @return string current user auth key
     */
    public function getAuthKey() {
	return $this->auth_key;
    }

    /**
     * @return int|string current user ID
     */  
    public function getId() {
	return $this->getPrimaryKey();
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey) {
	return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id) {
	return static::findOne(['user_id' => $id]);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null) {
	        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

//**************************************************************************************************************************************************/
    // Hash password
    public function hashPassword($password, $salt = NULL) {
        return strtoupper(hash('sha256', $salt . $password));
    }
    
    public function beforeSave($insert)
    {
	$this->validate();
	if (parent::beforeSave($insert)) {
	    //for HASHed password
	    $this->password = Yii::$app->security->generatePasswordHash($this->password);
	    
	    // salted HASHed password with personal function
	    //$this->password = $this->hashPassword($this->hashPassword($this->password), $this->salt);
	    
//******************************************************************************/
	    // NOT WORKING  salted HASHed password
	    //$tempPass = Yii::$app->security->generatePasswordHash($this->password);
	    //$saltedTempPass = $this->salt . $tempPass;
	    //$this->password = Yii::$app->security->generatePasswordHash($saltedTempPass);
//******************************************************************************/
	    return true;
	} else {
	    return false;
	}
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
	// Case insensetive username
        //return static::findOne(['username' => $username]);
	// Case sensetive username
	return static::find()->where('BINARY [[username]]=:user_name', ['user_name'=>$username])->one();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
	//for NON HASHed password
	//return $password === $this->password;
	
	//for HASHed password
        return Yii::$app->security->validatePassword($password, $this->password);
	
	// salted HASHed password with personal function
	//return ($this->password == $this->hashPassword($this->hashPassword($password), $this->salt));

//******************************************************************************/
	// NOT WORKING salted HASHed password
	//$tempPass = Yii::$app->security->generatePasswordHash($password);
	//$saltedTempPass = $this->salt . $tempPass;
	// Yii::$app->security->validatePassword($saltedTempPass, $this->password);
//******************************************************************************/
    }
    
    public function isAdmin()
    {
	if ($this->user_type_fk === User::USER_ADMIN) {
	    return true;
	} else {
	    return false;
	}
    }
    public function isStaff()
    {
	if ($this->user_type_fk === User::USER_STAFF) {
	    return true;
	} else {
	    return false;
	}
    }
} // END OF THE CLASS
