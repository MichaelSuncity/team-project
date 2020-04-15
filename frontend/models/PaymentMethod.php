<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "payment_method".
 *
 * @property int $id
 * @property string|null $name
 * @property int $user_id
 * @property int $created_at
 * @property int|null $updated_at
 *
 * @property CashFlows[] $cashFlows
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'payment_method';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
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
     * Gets query for [[CashFlows]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CashFlowsQuery
     */
    public function getCashFlows()
    {
        return $this->hasMany(CashFlows::className(), ['payment_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PaymentMethodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PaymentMethodQuery(get_called_class());
    }
}