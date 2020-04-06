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
use frontend\models\UserAvtorisation;
////


use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;


class UserController extends Controller  {

	public function actionUser(){
		$userName = \Yii::$app->user->identity->username;
		$userId=\Yii::$app->user->identity->id;
		$user = (new \yii\db\Query())
    		->select(["id","username","subname","email","created_at","updated_at"])
    		->from('user')
    		->where(['username' => $userName])
    		->andWhere(['id' => $userId])
    		->limit(2)
    		->all();
   
    

  
	return $this->render('user', [
               'user' => $user,
            ]);
}
}