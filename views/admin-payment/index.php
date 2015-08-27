<?php

use wartron\yii2account\billing\models\search\BillableItem;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;
use wartron\yii2uuid\helpers\Uuid;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var AccountSearch $searchModel
 */

$this->title = Yii::t('account-billing', 'Manage Payments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('account-billing', 'Billing'), 'url' => ['/billing/admin']];
$this->params['breadcrumbs'][] = $this->title;



Pjax::begin();

echo GridView::widget([
    'dataProvider'  => $dataProvider,
    'filterModel'   => $searchModel,
    'layout'        => "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'id',
            'value' => function ($m) {
                return Html::a(Uuid::uuid2str($m->id), ['view', 'id' =>  Uuid::uuid2str($m->id)]);
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'status',
            'filter' => [
                1   =>  'Active',
                2   =>  'Inactive',
            ],
        ],
        'amount',
        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                return date('Y-m-d G:i:s', $model->created_at);
            },
            'filter' => DatePicker::widget([
                'model'      => $searchModel,
                'attribute'  => 'created_at',
                'dateFormat' => 'php:Y-m-d',
                'options' => [
                    'class' => 'form-control',
                ],
            ]),
        ],

        [
            'class'     => ActionColumn::className(),
            'options'   => [
                'style' => 'width: 5%'
            ],
        ]
    ],
]);

Pjax::end();