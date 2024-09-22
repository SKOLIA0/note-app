<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%note}}`.
 */
class m240922_103636_create_note_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%note}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Добавляем внешний ключ к таблице `user`
        $this->addForeignKey(
            'fk-note-user_id',
            '{{%note}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-note-user_id', '{{%note}}');
        $this->dropTable('{{%note}}');
    }

}
