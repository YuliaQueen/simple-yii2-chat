<?php

namespace backend\modules\rbac\models\enums;

use yii2mod\enum\helpers\BaseEnum;

class Permission extends BaseEnum
{
    /** @var string админ. */
    public const ADMIN = 'admin';

    /** @var string обычный пользователь. */
    public const SIMPLE_USER = 'simple_user';

    /** @var string Доступ к управлению пользователями. */
    public const USER = 'user';

    /** @var string Доступ к управлению ролями и разрешениями. */
    public const RBAC = 'rbac';

    /** @var string Создание сообщений. */
    public const CREATE_MESSAGE = 'create_message';

    /** @var string Редактирование сообщений. */
    public const UPDATE_MESSAGE = 'update_message';

}
