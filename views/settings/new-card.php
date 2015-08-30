<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use wartron\yii2uuid\helpers\Uuid;

$this->title = Yii::t('account', 'New Card');
$this->params['breadcrumbs'][] = ['label' => Yii::t('account-billing', 'Billing'), 'url' => ['/billing/settings/index']];
$this->params['breadcrumbs'][] = $this->title;

$module = Yii::$app->getModule('account');

echo $this->render('@wartron/yii2account/views/_alert', ['module' => $module]);

?>

<div class="row">
    <div class="col-md-3">
        <?php
            echo $this->render('@wartron/yii2account/views/settings/_menu', ['module' => $module]);
        ?>
    </div>
    <div class="col-md-9">


    <?php



    ?>

    </div>
</div>
