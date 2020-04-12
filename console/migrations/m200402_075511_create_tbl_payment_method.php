<?php

use yii\db\Migration;


class m200402_075511_create_tbl_payment_method extends Migration
{
    
    public function up()
    {
        $this->createTable('payment_method', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            //'creator_id' => $this->integer()->notNull(),
            //'updater_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(), 
        ]);
    }

    public function down()
    {
        $this->dropTable('payment_method');
    }
}
