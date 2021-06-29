<?php

namespace common\models\queries;

use yii\db\ActiveQuery;

/**
 * MessageQuery represents the model behind the search form of `common\models\domains\Message`.
 */
class MessageQuery extends ActiveQuery
{
    /**
     * Добавляет условие на выборку неудаленных сообщений.
     * @return MessageQuery
     */
    public function notDeleted(): MessageQuery
    {
        return $this->andWhere(['deleted_at' => 0]);
    }

    /**
     * Добавляет условие на выборку корректных сообщений.
     * @return MessageQuery
     */
    public function whereCorrect(): MessageQuery
    {
        return $this->andWhere(['is_correct' => true]);
    }
}
