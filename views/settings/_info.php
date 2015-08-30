<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use wartron\yii2uuid\helpers\Uuid;


?>
<div class="panel panel-default">
    <div class="panel-heading">
        Billing Information
    </div>
    <div class="panel-body">

    <div class="clearfix">
        <p class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New Card', ['new-card'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <?php


        if($billingAccount)
        {
            echo "<pre>";
            print_r($billingAccount->toArray());
            echo "</pre>";
        }else{

            echo "No Billing Account";

        }

    ?>
    </div>
</div>