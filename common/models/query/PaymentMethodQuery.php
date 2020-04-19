<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\PaymentMethod]].
 *
 * @see \common\models\PaymentMethod
 */
class PaymentMethodQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
    
    public function byUser($userId)
    {
        return $this->andWhere(['user_id' => $userId]);
    }
    
    public function byCurrentUser()
    {
        return $this->byUser(\Yii::$app->user->id);
    }
    
    public function allPayments()
    {
        return $this->select('name')->byCurrentUser()->indexBy('id')->column();
    }

    /**
     * {@inheritdoc}
     * @return \common\models\PaymentMethod[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\PaymentMethod|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
