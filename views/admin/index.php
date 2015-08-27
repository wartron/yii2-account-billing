<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use wartron\yii2account\billing\models\search\BillableItem;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\web\View;
use yii\widgets\Pjax;
use wartron\yii2uuid\helpers\Uuid;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var AccountSearch $searchModel
 */

$this->title = Yii::t('billing', 'Manage Billable Items');
$this->params['breadcrumbs'][] = $this->title;

$module = Yii::$app->getModule('billing');


Pjax::begin();

echo GridView::widget([
    'dataProvider'  => $dataProvider,
    'filterModel'   => $searchModel,
    'layout'        => "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'status',
            'filter' => [
                1   =>  'Active',
                2   =>  'Inactive',
            ],
        ],
        [
            'attribute' => 'type',
            'filter' => [
                1   =>  'Product',
                2   =>  'Subscription',
            ],
        ],
        'amount',
        'name',
    ],
]);

Pjax::end();