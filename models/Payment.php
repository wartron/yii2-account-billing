<?php

namespace wartron\yii2account\billing\models;

use Exception;
use Yii;
use wartron\yii2account\billing\models\BillableItem;
use wartron\yii2account\billing\models\BillingAccount;

class Payment extends \wartron\yii2uuid\db\ActiveRecord
{
    const STATUS_PENDING            = 0;
    const STATUS_SUCCESSFUL         = 1;
    const STATUS_FAILED             = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'billing_payment';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ],
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'updatedByAttribute' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'amount'], 'required'],
            [['status', 'amount', 'created_at'], 'integer'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(BillableItem::className(), ['id' => 'billing_item_id'])->viaTable('billing_payment_item', ['payment_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillingaccount()
    {
        return $this->hasOne(BillingAccount::className(), ['id' => 'billing_account_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Date'),
        ];
    }

}