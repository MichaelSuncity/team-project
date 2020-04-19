<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\ExpensesCategory;

/* @var $this yii\web\View */
/* @var $model common\models\ExpensesCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории затрат', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="expenses-category-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Порядковый номер',
                'attribute' => 'id',
                'value'=>function (ExpensesCategory $model){
                    return "{$model->id}";
                }
            ],
            'title',
            //'user_id',
            [
                'label' => 'Затраты за сегодня',
                'value' => function(\common\models\ExpensesCategory $model) {
                    return $model->getTotalCategoryToday();
                }
            ],
            [
                'label' => 'Затраты в этом месяце',
                'value' => function(\common\models\ExpensesCategory $model) {
                    return $model->getTotalCategoryCurrentMonth();
                }
            ],
            [
                'label' => 'Итого затраты',
                'value' => function(\common\models\ExpensesCategory $model) {
                    return $model->getTotalCategory();
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
    <p>
        <?= Html::a('Редактировать категорию', Url::to(['/expensescategory/update', 'id' => $model->id]), ['class' => 'btn btn-success'] )  ?>
        <?= Html::a('Удалить категорию', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
