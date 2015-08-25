<?php

namespace wartron\yii2account\billing\backend\actions;


use wartron\yii2uuid\helpers\Uuid;
use wartron\yii2account\models\Account;
use Yii;

class PaymentsAction extends \yii\base\Action
{

    public function run($id)
    {
        $account = $this->findModel($id);

        return $this->controller->render('@wartron/yii2account/billing/backend/views/account-payments', [
            'account'   =>  $account,
        ]);
    }

    protected function findModel($id)
    {
        $id = Uuid::str2uuid($id);
        $account = Account::findOne($id);
        if ($account === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }
        return $account;
    }

}