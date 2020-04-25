<?php ////MMMOWWW /Недаработан
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\usersmodel;
use yii\db\Query;
use \yii\db\Exception;

class AdminController extends Controller{
public function actionUserscontroll(){
		


	return $this->render('userscontrolls');

}public function actionBdwork(){
		$Table = Yii::$app->db->createCommand("SHOW TABLES")->queryAll();
		$i = 0;
		
		$ANSWER = "";
		$model = new usersmodel();
		$SQL = Yii::$app->request->post("usersmodel");
		$SQL = $SQL["comand"];
		$qvery = Yii::$app->request->post("usersmodel");
		$qvery = $qvery["qvery"];
		$url = Yii::$app->urlManager->createAbsoluteUrl(['admin/bdwork']);
			switch ($qvery) {
				case "SELECT":
					$ANSWER = (new \yii\db\Query())
				 ->select(['id', 
					      'username',
					      'subname',
					      'auth_key',
					      'password_hash',
					      'password_reset_token',
					      'email',
					      'status',
					      'created_at',
					      'updated_at',
					      'verification_token'])
    			->from('user')
    			->limit(100)
    			->all();
				break;
			 case 'INSERT':
			  try{
			   $SQLinsert = $SQL;
			   $ANSWER=Yii::$app->db->createCommand($SQLinsert)->queryAll();
			  }catch(Exception $e){
			 	throw new \yii\web\NotFoundHttpException('Ошибка команды insert, составьте нормальную команду.Возможно ваш запрос не верен по архитектуре таблицы :'.$e);
			 	
			  }
			    break;
			 case 'DELETE':
			 try{
			  $SQLDelete = $SQL;
			  $ANSWER=Yii::$app->db->createCommand($SQLDelete)->queryAll();
			 }catch(Exception $e){
			 	throw new \yii\web\NotFoundHttpException('Ошибка команды delete, составьте нормальную команду.Возможно ваш запрос не верен по архитектуре таблицы :'.$e);
			 }
			    break;
			 case 'UPDATE':
			 try {
			  $SQLUpdate = $SQL;
			  $ANSWER=Yii::$app->db->createCommand($SQLUpdate)->queryAll();
			 }catch(Exception $e){
			 	throw new \yii\web\NotFoundHttpException('Ошибка команды update, составьте нормальную команду.Возможно ваш запрос не верен по архитектуре таблицы :'.$e);
			 }
			    break;
			 default:
			 $ANSWER= "EROR comand";
				break;
		}
		

			
	return $this->render('bdwork',["model"=>$model,
								"ANSWER"=>$ANSWER,
								"Table" => $Table,
								"tableCount"=>$tableCount,
								"SQL"=>$SQL]);
}
}


