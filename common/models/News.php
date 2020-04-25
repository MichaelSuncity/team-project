<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "News".
 *
 * @property int  $id
 * @property text $Header Название
 * @property text $News Сама новость
 * @property text $Author Автор
 * @property text Type_News Тип новости от кого (От владельца, от модера и т.д.)
 * @property date $Date Дата создания
 */
class News extends ActiveRecord
{
           public $id;
           public $Header;
           public $News;
           public $Author;
           public $Type_News;
           public $Date;


    public static function tableName()
    {
        return 'News';
    }

    
}
