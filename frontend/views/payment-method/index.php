<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\PaymentMethod;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PaymentMethodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Денежные средства';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-method-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новый счёт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Название счёта',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->name), Url::to(['/cash-flows/payment-method', 'payment_id' => $model->id]));
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Баланс',
                'value' => 'balance',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {replenish} {transfer}',
                'buttons' => [
                    'replenish' => function ($url, PaymentMethod $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('plus-sign');
                        return Html::a($icon, [
                            'operation',
                            'id' => $model->id,
                            ],
                            ['data' =>[
                                 'confirm' => 'Пополнить/снять со счёта?',
                                 'method' => 'post',
                                 'pjax' => 1,
                             ],]);
                    },
                    'transfer' => function ($url, PaymentMethod $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('transfer');
                        return Html::a($icon, [
                            'transfer',
                            'id' => $model->id,
                            ],
                            ['data' =>[
                                'confirm' => 'Сделать перевод?',
                                'method' => 'post',
                                'pjax' => 1,
                            ],]);
                    },
                ],
            ],
        ],
    ]); ?>
    
    

</div>
