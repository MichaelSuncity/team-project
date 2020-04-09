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
    ->setFrom('NeksusVita303@mail.com')
    ->setTo('NeksusVita303@mail.com')
    ->setSubject('Ты под калпоком')
    ->setTextBody('Ты стал околпаченным')
    ->setHtmlBody('<b>текст сообщения в формате HTML</b>')
    ->send();
    return $this->render('test');
 	}

}