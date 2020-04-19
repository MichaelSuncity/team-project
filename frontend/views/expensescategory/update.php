<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ExpensesCategory */

$this->title = 'Редактировать категорию затрат: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории затрат', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expenses-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
