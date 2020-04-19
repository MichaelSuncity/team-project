<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PaymentMethod;
use common\models\CashFlows;

/* @var $this yii\web\View */
/* @var $model common\models\CashFlows */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cash-flows-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>
    
    <?= $form->field($model, 'payment_id')->textInput()->dropDownList(PaymentMethod::getPaymentMethod()) ?>
    
    <?= $form->field($model, 'type')->textInput()->dropDownList(CashFlows::TYPES_LABELS) ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
