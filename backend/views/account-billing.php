<?php


use yii\helpers\Html;
use yii\helpers\Url;

$module = Yii::$app->getModule('account');

$this->beginContent('@wartron/yii2account/views/admin/update.php', [
    'title'     =>  'Billing',
    'account'   =>  $account,
]);

echo "<h4>Backend Billing</h4>";

if($billingAccount)
{
    echo "<pre>";
    print_r($billingAccount->toArray());
    echo "</pre>";
}else{

    echo "No Billing Account";

}



$this->endContent();