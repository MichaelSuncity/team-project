<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;

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
            'id',
            'title',
            'cost',
            'category_id',
            'method_id',
            //'user_id',
            'date',
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
