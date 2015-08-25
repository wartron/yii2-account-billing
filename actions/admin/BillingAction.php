<?php

namespace wartron\yii2account\billing\actions\admin;


use wartron\yii2uuid\helpers\Uuid;
use wartron\yii2account\models\Account;
use Yii;

class BillingAction extends \yii\base\Action
{

    public function run($id)
    {
        $account = $this->findModel($id);

        return $this->controller->render('@wartron/yii2account-billing/actions/admin/views/account-billing', [
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