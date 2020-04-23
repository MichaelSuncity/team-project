<?php

use yii\db\Migration;


class m200402_075809_News extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%News}}', [
            'id' => $this->integer()->primaryKey(),
            'Header' => $this->string(),
            'News' => $this->text(),
            'Author' => $this->text(),
            'Type_News' => $this->text(),
            'Date' => $this->date(),
            ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%News}}');
    }
    
}
