<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TransferForm */
/* @var $form ActiveForm */
$this->title = 'Перевод денежных средств';
$this->params['breadcrumbs'][] = ['label' => 'Денежные средства', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Перевод';

?>

<div class="payment-method-replenishForm">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>
        
        <?= $form->field($model, 'name')->textInput(['readonly' => true]) ?>
        
        <?= $form->field($model, 'recipient')->textInput()->dropDownList($model->possibleRecipients) ?>
        
        <?= $form->field($model, 'sum')->textInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- payment-method-replenishForm -->
