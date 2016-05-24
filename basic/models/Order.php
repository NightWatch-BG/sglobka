<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $order_id
 * @property integer $customer_fk
 * @property integer $staff_fk
 * @property integer $build_fk
 * @property integer $status_fk
 * @property string $notes
 * @property string $date_of_order
 * @property string $last_update
 *
 * @property BuildGuide $buildFk
 * @property User $customerFk
 * @property User $staffFk
 * @property Status $statusFk
 */
class Order extends \yii\db\ActiveRecord
{
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
            [['customer_fk', 'build_fk', 'status_fk', 'date_of_order'], 'required'],
            [['customer_fk', 'staff_fk', 'build_fk', 'status_fk'], 'integer'],
            [['date_of_order', 'last_update'], 'safe'],
            [['notes'], 'string', 'max' => 5000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'customer_fk' => 'Customer Fk',
            'staff_fk' => 'Staff Fk',
            'build_fk' => 'Build Fk',
            'status_fk' => 'Status Fk',
            'notes' => 'Notes',
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
}
