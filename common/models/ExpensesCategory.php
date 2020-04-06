<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\conditions\BetweenColumnsCondition;
use yii\db\conditions\BetweenCondition;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "expenses_category".
 *
 * @property int $id
 * @property string $title Название
 * @property int|null $user_id Создатель
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $user
 */
class ExpensesCategory extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => 'user_id',
            ],
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expenses_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'min' => 2, 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'user_id' => 'Создатель',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    public static function getExpensesCategory()
    {
        return ArrayHelper::map(
            self::find()
                ->where([
                    'user_id' =>yii::$app->user->identity->getId()
                ])
                ->asArray()
                ->all(),
            'id',
            'title');
    }

    public function getTotalCategory()
    {
        return Expenses::find()
            ->where(['category_id' => $this->id])
            ->sum('cost');
    }

    public function getTotalCategoryToday()
    {
        return Expenses::find()
            ->where(['category_id' => $this->id,
            'date'=> date('Y-m-d')])
            ->sum('cost');
    }

    public function getTotalCategoryCurrentMonth()
    {
        return Expenses::find()
            ->where(['category_id' => $this->id,
                'date'=> date('Y-m')])
            ->sum('cost');
    }
}
