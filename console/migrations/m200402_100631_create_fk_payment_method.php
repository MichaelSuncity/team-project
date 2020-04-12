<?php

use yii\db\Migration;


class m200402_100631_create_fk_payment_method extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('payment_method_fk1', 'payment_method', 'user_id', 'user', 'id', 'CASCADE');
    }
    
    public function safeDown()
    {
        $this->dropForeignKey('payment_method_fk1', 'payment_method');
    }

}
