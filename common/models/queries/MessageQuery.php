<?php

namespace common\models\queries;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\domains\Message;
use yii\db\ActiveQuery;

/**
 * MessageQuery represents the model behind the search form of `common\models\domains\Message`.
 */
class MessageQuery extends ActiveQuery
{
    /**
     * Добавляет условие на выборку неудаленных пользователей.
     * @return MessageQuery
     */
    public function notDeleted(): MessageQuery
    {
        return $this->andWhere(['deleted_at' => 0]);
    }

    public function whereCorrect(): MessageQuery
    {
        return $this->andWhere(['is_correct' => true]);
    }
}
