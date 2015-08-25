<?php

use yii\helpers\Html;

$this->title = Yii::t('account', 'Billing');
$this->params['breadcrumbs'][] = $this->title;

$module = Yii::$app->getModule('account');

echo $this->render('@wartron/yii2account/views/_alert', ['module' => $module]);

?>

<div class="row">
    <div class="col-md-3">
        <?php
            echo $this->render('@wartron/yii2account/views/admin/_menu', ['module' => $module]);
        ?>
    </div>
    <div class="col-md-9">
        Frontend Payments
    </div>
</div>
