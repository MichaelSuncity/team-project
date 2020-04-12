<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cash_flows".
 *
 * @property int $id
 * @property string|null $title
 * @property int $payment_id
 * @property int|null $type
 * @property int|null $operation_id
 * @property int|null $sum
 * @property int $user_id
 * @property int $created_at
 * @property int|null $updated_at
 *
 * @property PaymentMethod $payment
 * @property User $user
 */
class CashFlows extends \yii\db\ActiveRecord
{
    const TYPE_EXPENSE = 100;
    const TYPE_WITHDRAW = 200; //снятие withdraw 
    const TYPE_REPLENISH = 300; //пополнить replenish
    const TYPE_TRANSFER = 400;
    
    const TYPES = [
        self::TYPE_EXPENSE,
        self::TYPE_WITHDRAW,
        self::TYPE_REPLENISH,
        self::TYPE_TRANSFER,
    ];
    
    const TYPES_LABELS = [
        self::TYPE_EXPENSE => 'Покупка',
        self::TYPE_WITHDRAW => 'Снятие',
        self::TYPE_REPLENISH => 'Пополнение',
        self::TYPE_TRANSFER => 'Перевод',
    ];

    public static function tableName()
    {
        return 'cash_flows';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'user_id'], 'required'],
            [['payment_id', 'type', 'operation_id', 'sum', 'user_id'], 'integer'],
            [['type'], 'in', 'range' => self::TYPES],
            [['title'], 'string', 'max' => 255],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::className(), 'targetAttribute' => ['payment_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'payment_id' => 'Payment ID',
            'type' => 'Type',
            'operation_id' => 'Operation ID',
            'sum' => 'Sum',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function behaviors()
    {
        return [
            ['class' => TimestampBehavior::className()],
        ];
    }

    /**
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PaymentMethodQuery
     */
    public function getPayment()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'payment_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CashFlowsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CashFlowsQuery(get_called_class());
    }
}
