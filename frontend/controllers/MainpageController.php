<?php
namespace frontend\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use frontend\models\Mainpage;
use yii\db\ActiveQuery;
use common\models\User;

/**
 * Site controller
 */
class MainpageController extends Controller
{
    public function actionMain(){
        $userLastRegistered = User::find()
                ->orderBy(['created_at' => SORT_DESC])
                            ->limit(8)
                            ->asArray()
                            ->all();
        //$userLastRegistered = (new \yii\db\Query())
        //    ->select(["username","subname","created_at"])
        //    ->from('user')
        //    ->limit(15)
        //   ->all();
        //$userLastRegisteredresult=$userLastRegistered->orderBy(['created_at' =>SORT_DESC]);
        $userCount=(new \yii\db\Query())
            ->select(["id","username","subname"])
            ->from('user')
            ->count();
           $userLastRegisteredresult=$userLastRegistered;
            return $this->render('main', [
                'userLastRegisteredresult' => $userLastRegisteredresult,
                'userCount' => $userCount
            ]);
    }
}