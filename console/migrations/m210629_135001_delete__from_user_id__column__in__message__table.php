<?php

use yii\db\Migration;

/**
 * Class m210629_135001_delete__from_user_id__column__in__message__table
 */
class m210629_135001_delete__from_user_id__column__in__message__table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): bool
    {
        $this->dropForeignKey('fk__message__from_user_id__to__user__id', 'message');
        $this->dropColumn('message', 'from_user_id');

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): bool
    {
        $this->addColumn('message', 'from_user_id', $this->integer()->notNull());
        $this->addForeignKey(
            'fk__message__from_user_id__to__user__id',
            'message',
            'from_user_id',
            'user',
            'id'
        );

        return true;
    }
}
