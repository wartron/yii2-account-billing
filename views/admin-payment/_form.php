<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;




$form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableClientValidation' => false,
]);


echo $form->errorSummary($model);
echo '<p>';
echo $form->field($model, 'amount');
echo $form->field($model, 'status');
echo $form->field($model, 'description');
echo '</p>';

echo '<hr/>';

echo Html::submitButton(
    '<span class="glyphicon glyphicon-check"></span> ' . ($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
    [
        'id' => 'save-' . $model->formName(),
        'class' => 'btn btn-success'
    ]
);

ActiveForm::end();
