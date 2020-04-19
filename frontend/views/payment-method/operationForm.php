<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OperationForm */
/* @var $form ActiveForm */
$this->title = 'Пополнение/снятие ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Денежные средства', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Операция';

?>

<div class="payment-method-operationForm">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->field($model, 'operation')->textInput()->dropDownList($model->operations) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>
        
        <?= $form->field($model, 'sum')->textInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- payment-method-operationForm -->
