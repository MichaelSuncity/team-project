<?php /// MMMOWWW
namespace frontend\controllers;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use frontend\models\ModelsUser;
use yii\db\Connection;
use \yii\db\Query;


class UserController extends Controller {

public function actionUser(){


$user = (new \yii\db\Query())
    ->select(["id","username","subname","email","created_at","updated_at"])
    ->from('user')
    ->limit(10)
    ->all();
	return $this->render('user', [
               'user' => $user,
            ]);
}
}