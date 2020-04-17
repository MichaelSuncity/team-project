<?php


namespace frontend\modules\api\controllers;

use common\models\Expenses;
use yii\rest\ActiveController;

class ExpensesController extends  ActiveController
{
    public $modelClass = Expenses::class;
}