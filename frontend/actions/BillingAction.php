<?php

namespace wartron\yii2account\billing\frontend\actions;


use wartron\yii2uuid\helpers\Uuid;
use wartron\yii2account\models\Account;
use wartron\yii2account\billing\models\Payment;
use wartron\yii2account\billing\models\BillingAccount;
use wartron\yii2account\billing\models\search\Payment as PaymentSearch;
use Yii;

class BillingAction extends \yii\base\Action
{

    public function run()
    {
        $account = $this->findAccount();
        $paymentSearch  = Yii::createObject(PaymentSearch::className());
        $paymentDp = $paymentSearch->search(Yii::$app->request->get());
        $paymentDp->sort = false;

        $billingAccount = BillingAccount::findOne(['account_id' =>  $account->id]);

        return $this->controller->render('@wartron/yii2account/billing/frontend/views/account-billing', [
            'account'           =>  $account,
            'paymentSearch'     =>  $paymentSearch,
            'paymentDp'         =>  $paymentDp,
            'billingAccount'    =>  $billingAccount,
        ]);
    }

    protected function findAccount()
    {
        $account = Account::findOne(Yii::$app->user->identity->getId());
        if ($account === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }
        return $account;
    }

}