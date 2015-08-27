<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\helpers\Html;

/**
 * @var yii\web\View 				$this
 * @var wartron\yii2account\models\User 	$user
 */

$this->title = Yii::t('account-billing', 'Create a payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('account-billing', 'Billing'), 'url' => ['/billing/admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('account-billing', 'Payments'), 'url' => ['index']];
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
                    echo $this->render('_form', [
                        'model' => $model,
                    ]);
                ?>

            </div>
        </div>
    </div>
</div>
