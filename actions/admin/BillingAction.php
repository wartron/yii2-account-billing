<?php

namespace wartron\yii2account\billing\actions\admin;


use wartron\yii2uuid\helpers\Uuid;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecordInterface;
use yii\web\NotFoundHttpException;

class Action extends \yii\base\Action
{


    public function run($id)
    {
        return "account_id  ".Uuid::str2uuid($id);
    }


}