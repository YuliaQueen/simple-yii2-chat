<?php

namespace frontend\modules\api\controllers;

use common\models\domains\User;
use yii\rest\ActiveController;

class UsersController extends ActiveController
{
    public $modelClass = User::class;
}
