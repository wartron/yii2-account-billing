<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use wartron\yii2uuid\helpers\Uuid;
use ruskid\stripe\StripeForm;

$this->title = Yii::t('account', 'New Card');
$this->params['breadcrumbs'][] = ['label' => Yii::t('account-billing', 'Billing'), 'url' => ['/billing/settings/index']];
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
            <div class="panel-heading">New Card</div>
            <div class="panel-body">
                <?php
                    $form = StripeForm::begin([
                        'tokenInputName'        =>  'stripe_token',
                        'errorContainerId'      =>  'stripe-errors',
                        'brandContainerId'      =>  'cc-brand',
                        'errorClass'            =>  'has-error',
                        'applyJqueryPaymentFormat'         => true,
                        'applyJqueryPaymentValidation'     => true,
                        'options'               =>  ['autocomplete' => 'on'],

                    ]);
                ?>
                <div id="stripe-errors"></div>

                <div class="form-group">
                     <label for="name" class="control-label">Full Name</label>
                     <input id="name" name="full_name" class="form-control" required>
                </div>

                 <div class="form-group">
                     <label for="number" class="control-label">Card number</label>
                     <span id="cc-brand"></span>
                     <?= $form->numberInput() ?>
                 </div>

                 <div class="form-group">
                     <label for="cvc" class="control-label">CVC</label>
                     <?= $form->cvcInput() ?>
                 </div>

                 <div class="form-group">
                     <label for="exp-month-year" class="control-label">Card expiry</label>
                     <?= $form->monthAndYearInput() ?>
                 </div>

                <?php
                    echo Html::submitButton(
                        '<span class="glyphicon glyphicon-check"></span> Save',
                        [
                            'class' => 'btn btn-success'
                        ]
                    );

                    StripeForm::end();
                ?>

            </div>
        </div><!-- end panel -->


    </div>
</div>

