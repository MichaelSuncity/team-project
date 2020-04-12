<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "expenses".
 *
 * @property int $id
 * @property string $title Название
 * @property int $cost Сумма
 * @property int $category_id Категория расходов
 * @property int|null $method_id Способ оплаты
 * @property int|null $user_id Создатель
 * @property string|null $date Дата
 * @property string|null $description Описание
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Expenses extends ActiveRecord
{
    //поведения для заполнения полей создателя, времени создания и обновления
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
        return 'expenses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'cost', 'category_id', 'method_id', 'date'], 'required'],
            [['cost', 'category_id', 'method_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'min' => 2, 'max' => 100],
            [['description'], 'string', 'min' => 2, 'max' => 512],
            [['date'], 'date', 'format' =>'php:Y-m-d'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'cost' => 'Сумма',
            'category_id' => 'Категория расходов',
            'method_id' => 'Способ оплаты',
            'user_id' => 'Создатель',
            'date' => 'Дата',
            'description' => 'Описание',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    public function getExpensesAttachments()
    {
        return $this->hasMany(ExpensesAttachments::class, ['expenses_id' => 'id']);
    }
}
