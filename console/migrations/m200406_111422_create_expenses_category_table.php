<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%expenses_category}}`.
 */
class m200406_111422_create_expenses_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%expenses_category}}', [
            'id' => $this->primaryKey(),
            'title' => $this -> string()->notNull()->comment('Название'),
            'user_id' => $this -> integer()->comment('Создатель'),
            'created_at' => $this -> Integer(),
            'updated_at' => $this -> Integer(),
        ]);
        $this->addForeignKey(
            'fk-category-user_id',
            'expenses_category',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-category-user_id', 'expenses_category');
        $this->dropTable('{{%expenses_category}}');
    }
}
