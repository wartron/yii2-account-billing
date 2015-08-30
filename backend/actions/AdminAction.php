<?php

namespace wartron\yii2account\billing\backend\actions;


use wartron\yii2uuid\helpers\Uuid;
use wartron\yii2account\models\Account;
use Yii;

class AdminAction extends \yii\base\Action
{


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