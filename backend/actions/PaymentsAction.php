<?php

namespace wartron\yii2account\billing\backend\actions;


use wartron\yii2uuid\helpers\Uuid;
use wartron\yii2account\models\Account;
use wartron\yii2account\billing\models\Payment;
use wartron\yii2account\billing\models\search\Payment as PaymentSearch;
use Yii;

class PaymentsAction extends \yii\base\Action
{

    public function run($id)
    {
        $account = $this->findAccount($id);
        $paymentSearch  = Yii::createObject(PaymentSearch::className());
        $paymentDp = $paymentSearch->search(Yii::$app->request->get());

        return $this->controller->render('@wartron/yii2account/billing/backend/views/account-payments', [
            'account'           =>  $account,
            'paymentSearch'     =>  $paymentSearch,
            'paymentDp'         =>  $paymentDp,
        ]);
    }

    protected function findAccount($id)
    {
        $id = Uuid::str2uuid($id);
        $account = Account::findOne($id);
        if ($account === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }
        return $account;
    }

}