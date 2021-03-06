<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use wartron\yii2uuid\helpers\Uuid;

$module = Yii::$app->getModule('account');

$this->beginContent('@wartron/yii2account/views/admin/update.php', [
    'title'     =>  'Payments',
    'account'   =>  $account,
]);

echo GridView::widget([
    'dataProvider' => $paymentDp,
    'filterModel' => $paymentSearch,
    'columns' => [
        [
            'attribute' => 'id',
            'value' => function ($m) {
                return Html::a(Uuid::uuid2str($m->id), ['/billing/admin-payment/view', 'id' =>  Uuid::uuid2str($m->id)]);
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'status',
            'value' => function ($m) {
                switch ($m->status) {
                    case 1:
                        return '<span class="label label-default">Paid</span>';
                        break;
                    case 2:
                        return '<span class="label label-warning">Unpaid</span>';

                        break;
                    default:
                        return '';
                        break;
                }
            },
            'format' => 'raw',
        ],
        'amount:cent',
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



$this->endContent();