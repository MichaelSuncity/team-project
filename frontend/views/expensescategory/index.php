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
<!-- добавление узла для vue-->
<div id="app">
    <!-- Кнопка для запуска модального окна -->
    <button type="button" @click="handleClickShow" id="showBtn" class="showBtn" data-toggle="modal" data-target="#exampleModalCenter">
        Добавить категорию
    </button>

    <!-- модальное окно для создания новой категории-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Создать новую категорию</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <addform @onadd="handleClickAdd" @oneditsave="handleClickEditSave"></addform>
                </div>
            </div>
        </div>
    </div>

    <!-- Компонент vue  для отображения списка категорий -->
    <expensescategory @onremove="handleClickRemove" @onedit="handleClickEdit"  :items="items"></expensescategory>
</div>

<!-- подключение css, vue, js скрипта для страница -->
<?php $this->registerCssFile('@web/css/expensescategoryindex.css');?>
<?php $this->registerJsFile('https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.min.js');?>
<?php $this->registerJsFile('@web/js/appCategory.js');?>
