<?php

use yii\db\Migration;


class m200402_075809_create_fk_cash_flows extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('cash_flows_fk1', 'cash_flows', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('cash_flows_fk2', 'cash_flows', 'payment_id', 'payment_method', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('cash_flows_fk1', 'cash_flows');
        $this->dropForeignKey('cash_flows_fk2', 'cash_flows'); 
    }
    
}
