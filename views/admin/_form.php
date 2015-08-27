<?php
    $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'enableClientValidation' => false,
    ]);
?>

<div class="">
    <?php

    echo $form->errorSummary($model);
    echo '<p>';
    echo $form->field($model, 'name')->textInput(['maxlength' => true]);
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

    ?>

</div>