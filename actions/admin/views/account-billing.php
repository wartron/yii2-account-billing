<?php


use yii\helpers\Html;
use yii\helpers\Url;

$module = Yii::$app->getModule('account');

$this->beginContent('@wartron/yii2account/views/admin/update.php', [
    'title'     =>  'Billing',
    'account'   =>  $account,
]);


echo "<h4>Billing</h4>";



$this->endContent();