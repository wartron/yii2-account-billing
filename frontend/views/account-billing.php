<?php

use yii\helpers\Html;
use yii\helpers\Url;
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
                Billing Information
            </div>
            <div class="panel-body">


            </div>
        </div>
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
                                return '<i class="glyphicon glyphicon-credit-card"></i> ****-****-****-1234';
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
    </div>
</div>
