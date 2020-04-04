<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%expenses_attachments}}`.
 */
class m200404_144044_create_expenses_attachments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%expenses_attachments}}', [
            'id' => $this->primaryKey(),
            'expenses_id' => $this->integer(),
            'path' => $this->string()
        ]);
        $this->addForeignKey(
            'fk-image-expenses_id',
            'expenses_attachments',
            'expenses_id',
            'expenses',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%expenses_attachments}}');
        $this->dropForeignKey('fk-image-expenses_id','expenses_attachments');
    }
}
