<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use common\models\Expenses;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ExpensesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расходы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenses-index">

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
            [
                'label' => 'Категория затрат',
                'attribute' => 'category_id',
                'value' => function(Expenses $model) {
                    return $model->expensesCategory->title;
                }
            ],
            [
                'label' => 'Способ оплаты',
                'attribute' => 'method_id',
                'value' => function(Expenses $model) {
                    return $model->paymentMethod->name;
                }
            ],
            //'user_id',
            'date',
            'cost',
            //'description',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>
        <?= Html::a('Добавить запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<<<<<<< HEAD
</div>
=======
</div>
>>>>>>> DEV
