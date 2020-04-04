<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Expenses */
/* @var \common\models\ExpensesAttachmentsAddForm $expensesAttachmentForm */

$this->title = 'Редактировать запись: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Расходы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'редактирование';
?>
<div class="expenses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <div class="attachments">
        <h3>Приложения</h3>
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['expenses/addattachment']),
            'options' => ['class' => "form-inline"]
        ]);?>
        <?=$form->field($expensesAttachmentForm, 'expenses_id')->hiddenInput(['value' => $model->id])->label(false);?>
        <?=$form->field($expensesAttachmentForm, 'attachment')->fileInput();?>
        <?=Html::submitButton("Добавить",['class' => 'btn btn-success']);?>
        <?ActiveForm::end()?>
        <hr>
        <div class="attachments-history">
            <?foreach ($model->expensesAttachments as $file): ?>
                <a href="/img/expenses/<?=$file->path?>">
                    <img src="/img/expenses/small/<?=$file->path?>" alt="">
                </a>
            <?php endforeach;?>
        </div>
    </div>
</div>
