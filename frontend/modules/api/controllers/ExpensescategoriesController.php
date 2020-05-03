<?php


namespace frontend\modules\api\controllers;


use common\models\ExpensesCategory;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\data\ActiveDataProvider;

class ExpensescategoriesController extends ActiveController
{
    public $modelClass = ExpensesCategory::class;

    public function actionAuth()
    {
        return new ActiveDataProvider([
            'query' => ExpensesCategory::find()->where([
                'user_id' => \Yii::$app->user->id
            ]),
            //'pagination' => false
            /*'pagination' => [
                'pageSize' => 2
            ]*/
        ]);
    }
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