<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CashFlows */

$this->title = 'Create Cash Flows';
$this->params['breadcrumbs'][] = ['label' => 'Cash Flows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-flows-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
