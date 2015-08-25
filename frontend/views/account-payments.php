<?php

use yii\helpers\Html;

$this->title = Yii::t('account', 'Payments');
$this->params['breadcrumbs'][] = $this->title;


echo $this->render('@wartron/yii2account/views/_alert', ['module' => Yii::$app->getModule('account')]);

?>

<div class="row">
    <div class="col-md-3">
        <?php
            echo $this->render('@wartron/yii2account/views/admin/_menu');
        ?>
    </div>
    <div class="col-md-9">
        Frontend Payments
    </div>
</div>
