<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Expenses;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Expenses */
/* @var \common\models\ExpensesAttachmentsAddForm $expensesAttachmentForm */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Расходы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="expenses-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Порядковый номер',
                'attribute' => 'id',
                'value'=>function (Expenses $model){
                    return "{$model->id}";
                }
            ],
            'title',
            'cost',
            'category_id',
            'method_id',
            //'user_id',
            'date',
            'description',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
    <p><?= Html::a('Редактировать запись', Url::to(['/expenses/update', 'id' => $model->id]), ['class' => 'btn btn-success'] )  ?>
        <?= Html::a('Удалить запись', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php if(!empty($model->expensesAttachments)):?>
    <div class="attachments">
        <h3>Приложения</h3>
        <div class="attachments-history">
            <?foreach ($model->expensesAttachments as $file): ?>
                <a href="/img/expenses/<?=$file->path?>">
                    <img src="/img/expenses/small/<?=$file->path?>" alt="">
                </a>
            <?php endforeach;?>
        </div>
    </div>
    <?php endif;?>

    <p><?= Html::a('Вернуться к списку', Url::to(['/expenses/index']) ) ?></p>
</div>
