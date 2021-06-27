<?php

namespace frontend\modules\api\controllers;

use common\models\domains\Message;
use yii\rest\ActiveController;


class MessagesController extends ActiveController
{
    public $modelClass = Message::class;
}
