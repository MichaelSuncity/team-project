<?php /// MMMOWW
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class UserAvtorisation extends ActiveRecord{
	public $username;
	public $subname;
	public $email;
	public $password_hash; 

} 