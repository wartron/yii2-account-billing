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
            <div class="panel-body">
                <?php

                echo GridView::widget([
                    'dataProvider' => $paymentDp,
                    'columns' => [
                        [
                            'attribute' => 'id',
                            'value' => function ($m) {
                                return Html::a(Uuid::uuid2str($m->id), ['/billing/payment/view', 'id' =>  Uuid::uuid2str($m->id)]);
                            },
                            'format' => 'raw',
                        ],
                        'status',
                        [
                            'attribute' => 'amount',
                            'value' => function ($m) {
                                return Yii::$app->formatter->asCurrency($m->amount/100);
                            },
                            'format' => 'raw',
                        ],
                        'description',
                        [
                            'attribute' =>  'created_at',
                            'format'    =>  'raw',
                            'value'     =>  function($m) {
                                $relativeTime = \Yii::$app->formatter->asRelativeTime($m['created_at']);
                                $formatedTime = \Yii::$app->formatter->asDatetime($m['created_at']);
                                return '<span title="'.$formatedTime.'">'.$relativeTime.'</span>';
                            }
                        ],
                    ],
                ]);

                ?>

            </div>
        </div>
    </div>
</div>
