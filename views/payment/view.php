<?php


use yii\bootstrap\Nav;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use wartron\yii2uuid\helpers\Uuid;


$this->title = Yii::t('account', 'Billing');
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

        <div class="panel panel-default">
            <div class="panel-heading">
                Payment Details
            </div>
            <div class="panel-body">
                <?php

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id:hex',
            'status',
            'amount',
            'description',
            'created_at',
        ],
    ]);


    echo GridView::widget([
        'dataProvider'  => $itemsDp,
        'columns' => [
            'name',
        ],
    ]);


                ?>

            </div>
        </div>
    </div>
</div>
