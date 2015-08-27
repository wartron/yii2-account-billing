<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\Nav;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use wartron\yii2account\models\Account;
use wartron\yii2uuid\helpers\Uuid;
/**
 * @var View    $this
 * @var Account     $model
 * @var string  $content
 */

$this->title = Yii::t('account-billing', 'View Billable Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('account-billing', 'Billing'), 'url' => ['/billing/admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('account-billing', 'Billables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name , 'url' => ['view', 'id' => Uuid::uuid2str($model->id)] ];
$this->params['breadcrumbs'][] = $this->title;




?>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">

            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
    <?php

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id:hex',
            'name',
            'status',
            'type',
            'amount',
            'description',
            'data',
            'created_at',
            'created_by:hex',
            'updated_at',
            'updated_by:hex',
        ],
    ]);

    ?>

            </div>
        </div>
    </div>
</div>
