<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CashFlows */

$this->title = 'Update Cash Flows: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cash Flows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cash-flows-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
