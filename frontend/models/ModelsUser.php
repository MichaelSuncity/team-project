<?php /// MMMOWWW

namespace frontend\models\ModelsUser;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
class ModelUser extends ActiveRecord
{
    public $id;
    public $username;
    public $subname;
    public $email;
    public $created_at;
    public $updated_at;
    public static function tableName()
    {
        return "user"; 
    }
 
}