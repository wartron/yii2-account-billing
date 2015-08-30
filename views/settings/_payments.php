<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use wartron\yii2uuid\helpers\Uuid;


?>

<div class="panel panel-default">
    <div class="panel-heading">
        Payment History
    </div>
    <?php

        echo GridView::widget([
            'tableOptions' => [
                'class' => 'table table-stripped',
            ],
            'dataProvider'  =>  $paymentDp,
            'layout'        =>  '{items}',
            'columns' => [
                [
                    'attribute' => 'status',
                    'label'     =>  '',
                    'value' => function ($m) {
                        switch ($m->status) {
                            case 1:
                                return '&nbsp;&nbsp;<i class="glyphicon glyphicon-check"></i> ';
                                break;
                            case 2:
                                return '&nbsp;&nbsp;<i class="glyphicon glyphicon-remove"></i> ';
                                break;
                            default:
                                break;
                        }
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'id',
                    'value' => function ($m) {
                        return Html::a(substr(Uuid::uuid2str($m->id),0,8)."...", ['/billing/payment/view', 'id' =>  Uuid::uuid2str($m->id)]);
                    },
                    'format' => 'raw',
                ],
                'created_at:date',
                [
                    'attribute' => 'amount',
                    'value' => function ($m) {
                        return Yii::$app->formatter->asCurrency($m->amount/100);
                    },
                    'format' => 'raw',
                ],
                'description',

                [
                    'label'     =>  'Payment Method',
                    'value'     =>  function ($m) {
                        if($m->billingaccount){
                            return '<i class="glyphicon glyphicon-credit-card"></i> ****-****-****-'.$m->billingaccount->cc_last4;
                        }
                        return "";
                    },
                    'format' => 'raw',
                ],
                [
                    'label'     =>  'Receipt',
                    'value'     =>  function ($m) {
                        return '<div class="text-center">'.
                            Html::a('<i class="glyphicon glyphicon-download"></i>',['/billing/payment/download', 'id' =>  Uuid::uuid2str($m->id)]).
                        '</div>';
                    },
                    'headerOptions' =>  [
                        'style' =>  'text-align:center;',
                    ],
                    'format' => 'raw',
                ],



            ],
        ]);

    ?>
</div>