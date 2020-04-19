<?php

namespace common\models\query;

use common\models\CashFlows;

/**
 * This is the ActiveQuery class for [[\common\models\CashFlows]].
 *
 * @see \common\models\CashFlows
 */
class CashFlowsQuery extends \yii\db\ActiveQuery
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
    
    public function byPayment($paymentId)
    {
        return $this->andWhere(['payment_id' => $paymentId]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CashFlows[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\CashFlows|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
