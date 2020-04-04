<?php /// MMMOWWW
namespace frontend\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use frontend\models\UserRegistration;
use \yii\db\Query;
//////
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

//////


class UserregistrationController extends Controller
{
	public function actionRegistration()
    {		 
/*



      $RegistrationData = new UserRegistration();
    	 	
    	 	$request = Yii::$app->request;
            $RegistrationRequest = $request->post("UserRegistration");
            
           if($RegistrationRequest['password1'] == $RegistrationRequest['password2']){
            if($RegistrationRequest['username'] != NULL){
$name = $RegistrationRequest['username'];
$subname = $RegistrationRequest['subname'];
$auth_key = "1";
$password_hash = $RegistrationRequest['password_hash'];
$email = $RegistrationRequest["email"];
$test = $email;
$dateCreate = explode(" ", microtime());
            	$sql = "INSERT INTO `user` (`id`, 
                                            `username`,
                                             `subname`, 
                                             `auth_key`, 
                                             `password_hash`, 
                                             `password_reset_token`,
                                              `email`, 
                                              `status`, 
                                              `created_at`,
                                               `updated_at`,
                                               `verification_token`)
                         VALUES (NULL, '".$name."',
                                     '".$subname."', 
                                     '".$auth_key."', 
                                     '".$password_hash."
                                     ', NULL, '
                                     ".$email."',
                                      '1', 
                                      '".$dateCreate[1]."', 
                                      '".$dateCreate[1]."', 
                                      'rZz48HTyWmStTjmWg6bZeT5rSnYtZrHx_1585742847');";
                Yii::$app->db->createCommand($sql)->execute();
                $test = Yii::$app->getSecurity()->generatePasswordHash($RegistrationRequest['password_hash']);
                                       $test = $email;


            }}
            
        return $this->render('registration',[
               'RegistrationData' => $RegistrationData,
               'test'=>$test
            ]);




        */
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    
}
