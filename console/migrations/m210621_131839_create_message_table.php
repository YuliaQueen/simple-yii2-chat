<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m210621_131839_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): bool
    {
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'from_user_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'is_correct' => $this->boolean()->defaultValue(true),
            'is_admin_create' => $this->boolean()->defaultValue(false),
            'deleted_at' => $this->integer()->notNull()->defaultValue(0),
            'created_by_id' => $this->bigInteger(),
            'updated_by_id' => $this->bigInteger(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk__message__from_user_id__to__user__id',
            'message',
            'from_user_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk__message__created_by_id__to__user__id',
            'message',
            'created_by_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk__message__updated_by_id__to__user__id',
            'message',
            'updated_by_id',
            'user',
            'id'
        );

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): bool
    {
        $this->dropForeignKey('fk__message__updated_by_id__to__user__id', 'message');
        $this->dropForeignKey('fk__message__created_by_id__to__user__id', 'message');
        $this->dropForeignKey('fk__message__from_user_id__to__user__id', 'message');
        $this->dropTable('{{%message}}');

        return true;
    }
}
