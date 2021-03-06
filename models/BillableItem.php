<?php

namespace wartron\yii2account\billing\models;

use Exception;
use Yii;

class BillableItem extends \wartron\yii2uuid\db\ActiveRecord
{
    const STATUS_INACTIVE           = 0;
    const STATUS_ACTIVE             = 1;

    const TYPE_MISC                 = 0;
    const TYPE_RECURRING            = 10;


    /** @inheritdoc */
    public function init()
    {
        parent::init();
    }

    /** @inheritdoc */
    public static function tableName()
    {
        return 'billing_item';
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
            \yii\behaviors\BlameableBehavior::className(),
        ];
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['name', 'amount', 'type', 'status'], 'required'],
            [['amount', 'type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['data'], 'string', 'max' => 10*1024],
        ];
    }

}