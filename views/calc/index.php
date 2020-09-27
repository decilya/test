<?php

/**
 * @var \app\models\CalcForm $model
 * @var string $str
 */

use yii\widgets\ActiveForm;

$this->title = 'Calculator';
?>

<div class="request-form">
    <div class="container">
        <?php
        $form = ActiveForm::begin([
            'enableAjaxValidation' => true,
            'id' => 'form-calc',
            'options' => [
                'class' => 'form-horizontal col-lg-12',
                'enctype' => 'multipart/form-data',
                'data-role' => 'mainForm',
                'data-model-name' => $model->formName(),
            ],
        ]);
        ?>

        <?= $form->field($model, 'number1')->textInput(['maxlength' => true]); ?>

        <?= $form->field($model, 'myOperation')->dropDownList($model->operation); ?>

        <?= $form->field($model, 'number2')->textInput(['maxlength' => true]); ?>

        <input name="submit" type="submit" value="Calculate" class="btn btn-primary"/>

        <?php ActiveForm::end(); ?>

        <?php
        if ($str){
            echo "$str";
        }
        ?>

    </div>
</div>
