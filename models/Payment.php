<?php

namespace wartron\yii2accountbilling\models;

use Exception;
use Yii;
use wartron\yii2accountbilling\models\BillableItem;

class Payment extends \yii\db\ActiveRecord
{
    const STATUS_PENDING            = 0;
    const STATUS_SUCCESSFUL         = 1;
    const STATUS_FAILED             = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
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
            [['status', 'amount', 'account_id', 'created_at', 'created_by'], 'integer'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(BillableItem::className(), ['id' => 'billable_item_id'])->viaTable('payment_item', ['payment_id' => 'id']);
    }


}