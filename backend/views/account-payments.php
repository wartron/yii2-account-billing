<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$module = Yii::$app->getModule('account');

$this->beginContent('@wartron/yii2account/views/admin/update.php', [
    'title'     =>  'Payments',
    'account'   =>  $account,
]);

echo GridView::widget([
    'dataProvider' => $paymentDP,
    'filterModel' => $paymentSearch,
    'columns' => [
        'id',
        'status',
        'amount',
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