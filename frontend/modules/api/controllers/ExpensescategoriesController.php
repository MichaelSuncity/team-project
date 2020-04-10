<?php


namespace frontend\modules\api\controllers;


use common\models\ExpensesCategory;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class ExpensescategoriesController extends ActiveController
{
    public $modelClass = ExpensesCategory::class;
    //проверка доступа для просмотра чужих категорий
    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === 'view') {
            if ($model->user_id !== \Yii::$app->user->id) {
                throw new ForbiddenHttpException('Нельзя смотреть категории где вы не являетесь автором');
            }
        }
    }

    /*public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];

        return $behaviors;

    }*/
}