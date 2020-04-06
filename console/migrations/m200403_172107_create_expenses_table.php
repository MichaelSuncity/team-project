<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%expenses}}`.
 */
class m200403_172107_create_expenses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%expenses}}', [
            'id' => $this->primaryKey(),
            'title' => $this -> string()->notNull()->comment('Название'),
            'cost' => $this -> integer()->notNull()->comment('Сумма'),
            'category_id' => $this -> integer()->notNull()->comment('Категория расходов'),
            'method_id' => $this -> integer()->comment('Способ оплаты'),
            'user_id' => $this -> integer()->comment('Создатель'),
            'date' => $this ->date()->comment('Дата'),
            'description' => $this -> string()->comment('Описание'),
            'created_at' => $this -> Integer(),
            'updated_at' => $this -> Integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%expenses}}');
    }
}
