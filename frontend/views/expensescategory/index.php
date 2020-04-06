<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ExpensesCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории затрат';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenses-category-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => SerialColumn::class,
                'header' => 'Псевдо-порядковый класс',
            ],
            //'id',
            'title',
            'user_id',
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
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
