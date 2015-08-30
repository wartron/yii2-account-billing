<?php

namespace wartron\yii2account\billing\backend\actions;


use wartron\yii2uuid\helpers\Uuid;
use Yii;
use wartron\yii2account\billing\models\BillingAccount;
//use wartron\yii2account\billing\models\search\BillingAccount as BillingAccountSearch;

class BillingAction extends AdminAction
{

    public function run($id)
    {
        $account = $this->findAccount($id);
        $billingAccount = BillingAccount::findOne(['account_id' =>  $account->id]);

        return $this->controller->render('@wartron/yii2account/billing/backend/views/account-billing', [
            'account'           =>  $account,
            'billingAccount'    =>  $billingAccount
        ]);
    }

}