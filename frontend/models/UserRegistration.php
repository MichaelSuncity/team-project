<? /// MMMOWWW
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class UserRegistration extends ActiveRecord{
	public $id;
	public $username;
	public $subname;
	public $email;
	public $password_hash;
	public $password1;
	public $password2;  
    public static function tableName()
    {
        return 'user';
    }


}