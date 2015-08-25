<?php

namespace wartron\yii2account\billing\frontend\actions;


use wartron\yii2uuid\helpers\Uuid;
use wartron\yii2account\models\Account;
use Yii;

class PaymentsAction extends \yii\base\Action
{

    public function run()
    {
        $account = $this->findModel();

        return $this->controller->render('@wartron/yii2account/billing/frontend/views/account-payments', [
            'account'   =>  $account,
        ]);
    }

    protected function findModel()
    {
        $account = Account::findOne(Yii::$app->user->identity->getId());
        if ($account === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }
        return $account;
    }

}