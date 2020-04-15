<?php
namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use yii\swiftmailer\Mailer;


/**
 * EmailVerificator
 */
class EmailverificatorController extends Controller
{

 	public function actionVerification(){
 	Yii::$app->mailer->compose()
    ->setFrom('mail@mail.com')
    ->setTo('mail@mail.com')
    ->setSubject('Ты под калпоком')
    ->setTextBody('Мы тебя видим')
    ->setHtmlBody('<b>текст сообщения в формате HTML</b>')
    ->send();
    return $this->render('test');
 	}

}