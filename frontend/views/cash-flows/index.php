<?php

use yii\helpers\Html;
use yii\helpers\Url; 
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CashFlowsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cash Flows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-flows-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Счёт',
                'attribute' => 'payment_id',
                'filter' => $payments,
                'value' => function($model) {
                    return Html::a(Html::encode($model->payment->name), Url::to(['payment-method/view', 'id' => $model->payment->id]));
                },
                'format' => 'raw',
            ],
            'date',
            'title',
            'sum',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
