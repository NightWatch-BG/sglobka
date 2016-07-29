<?php

namespace app\models;

use Yii;
use app\models\BuildGuide;
/**
 * This is the model class for table "order".
 *
 * @property integer $order_id
 * @property integer $customer_fk
 * @property integer $staff_fk
 * @property integer $build_fk
 * @property integer $status_fk
 * @property string $notes
 * @property string $staff_notes
 * @property string $date_of_order
 * @property string $last_update
 *
 * @property User $customerFk
 * @property User $staffFk
 * @property BuildGuide $buildFk
 * @property Status $statusFk
 */
class Order extends \yii\db\ActiveRecord
{
    const STAT_PENDING =1;
    const STAT_RECEIVED = 2;
    const STAT_IN_PROGRESS = 3;
    const STAT_READY = 4;
    const STAT_SHIPPED = 5;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_fk', 'build_fk', 'status_fk'], 'required'],
            [['customer_fk', 'staff_fk', 'build_fk', 'status_fk'], 'integer'],
            [['date_of_order', 'last_update'], 'safe'],
            [['notes', 'staff_notes'], 'string', 'max' => 5000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'customer_fk' => 'Customer',
            'staff_fk' => 'Staff',
            'build_fk' => 'Build',
            'status_fk' => 'Status',
            'notes' => 'Notes',
            'staff_notes' => 'Staff Notes',
            'date_of_order' => 'Date Of Order',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildFk()
    {
        return $this->hasOne(BuildGuide::className(), ['build_guide_id' => 'build_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerFk()
    {
        return $this->hasOne(User::className(), ['user_id' => 'customer_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffFk()
    {
        return $this->hasOne(User::className(), ['user_id' => 'staff_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusFk()
    {
        return $this->hasOne(Status::className(), ['status_id' => 'status_fk']);
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
    /**
     * AFTER SAVE
     */   
    public function afterSave($insert, $changedAttributes) {
	$buildInOrder = $this->getBuildFk()->one();
	$buildInOrder->in_order = $buildInOrder::ORDERED;
	$buildInOrder->update();
	parent::afterSave($insert, $changedAttributes);
    }
    
//**************************************************************************************************************************************************/   
    public static function getNewOrders() {
	return Order::find()->where(['status_fk' => Order::STAT_PENDING])->count();
    }
    
//**************************************************************************************************************************************************/    
}// END OF THE MODEL
