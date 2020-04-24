<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\ExpensesCategory]].
 *
 * @see \common\models\ExpensesCategory
 */
class ExpensesCategoryQuery extends \yii\db\ActiveQuery
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

    /**
     * {@inheritdoc}
     * @return \common\models\ExpensesCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\ExpensesCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
