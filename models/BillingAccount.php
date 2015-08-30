<?php

namespace wartron\yii2account\billing\models;



class BillingAccount extends \wartron\yii2uuid\db\ActiveRecord
{
    const STATUS_PENDING    = 0;
    const STATUS_ACTIVE     = 1;
    const STATUS_FAILED     = 2;

    const CC_TYPE_UNKNOWN  = 0;
    const CC_TYPE_VISA     = 1;
    const CC_TYPE_AMEX     = 2;


    public $uuidRelations = ['account_id'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'billing_account';
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
            [['account_id'], 'required'],
            [['status', 'status', 'created_at'], 'integer'],
            [['full_name'], 'string', 'max' => 255],
            [['cc_last4', 'cc_type', 'cc_year', 'cc_month'], 'integer'],
            [['stripe_token','stripe_card_token'], 'string', 'max' => 255],
        ];
    }


}