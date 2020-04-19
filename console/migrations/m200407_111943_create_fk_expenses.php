<?php

use yii\db\Migration;

/**
 * Class m200407_111943_create_fk_expenses
 */
class m200407_111943_create_fk_expenses extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('expenses_fk1', 'expenses', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('expenses_fk2', 'expenses', 'method_id', 'payment_method', 'id', 'CASCADE');
        $this->addForeignKey('expenses_fk3', 'expenses', 'category_id', 'expenses_category', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('cash_flows_fk1', 'expenses');
        $this->dropForeignKey('cash_flows_fk2', 'expenses'); 
        $this->dropForeignKey('cash_flows_fk3', 'expenses'); 
    }
}
