<?php

use yii\db\Migration;


class m200402_073627_create_tbl_cash_flows extends Migration
{
    public function Up()
    {
        $this->createTable('cash_flows', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'date' => $this->integer()->notNull(),
            'payment_id' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            'operation_id' => $this->integer(),
            'sum' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            //'creator_id' => $this->integer()->notNull(),
            //'updater_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(), 
        ]);
    }

    public function Down()
    {
        $this->dropTable('cash_flows');
    }

}
