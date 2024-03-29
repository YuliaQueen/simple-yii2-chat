<?php

namespace common\models\enums;


use yii2mod\enum\helpers\BaseEnum;


/**
 * Перечисление типов пользователей
 */
class UserType extends BaseEnum
{
    public const SYSTEM = 1;
    public const USER = 2;
    public const ADMIN = 3;

    /**
     * @var array
     */
    protected static $list = [
        self::SYSTEM => 'Система',
        self::USER => 'Пользователь',
        self::ADMIN => 'Администратор',
    ];
}
