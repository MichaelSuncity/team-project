<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ExpensesCategory */

$this->title = 'Создать категорию затрат';
$this->params['breadcrumbs'][] = ['label' => 'Категория затрат', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenses-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
