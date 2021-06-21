<?php

use backend\modules\rbac\models\enums\Permission;
use backend\modules\rbac\RbacService;
use yii\db\Migration;

class m210621_192400_create_rbac_permissions extends Migration
{
    /**
     * @return bool|void
     * @throws \yii\base\Exception
     * @throws Exception
     * @noinspection PhpUnused
     */
    public function safeUp()
    {
        /** @var RbacService $rbacService */
        $rbacService = Yii::$app->rbacService;

        $rbacService->createRole(Permission::ADMIN, 'Админ');
        $rbacService->createRole(Permission::SIMPLE_USER, 'Пользователь');

        $rbacService->createPermission(Permission::USER, 'Управление пользователями');
        $rbacService->createPermission(Permission::RBAC, 'Управление разрешениями');
        $rbacService->createPermission(Permission::CREATE_MESSAGE, 'Создание сообщений');
        $rbacService->createPermission(Permission::UPDATE_MESSAGE, 'Редактирование сообщений');

        $rbacService->addChild(Permission::ADMIN, Permission::USER);
        $rbacService->addChild(Permission::ADMIN, Permission::RBAC);
        $rbacService->addChild(Permission::ADMIN, Permission::CREATE_MESSAGE);
        $rbacService->addChild(Permission::ADMIN, Permission::UPDATE_MESSAGE);

        $rbacService->addChild(Permission::SIMPLE_USER, Permission::CREATE_MESSAGE);

        return true;
    }

    /**
     * @return bool|void
     * @noinspection PhpUnused
     */
    public function safeDown()
    {
        /** @var RbacService $rbacService */
        $rbacService = Yii::$app->rbacService;

        $rbacService->removeChild(Permission::ADMIN, Permission::RBAC);
        $rbacService->removeChild(Permission::ADMIN, Permission::USER);
        $rbacService->removeChild(Permission::ADMIN, Permission::CREATE_MESSAGE);
        $rbacService->removeChild(Permission::ADMIN, Permission::UPDATE_MESSAGE);

        if ($rbacService->findItem(Permission::UPDATE_MESSAGE)) {
            $rbacService->removePermission(Permission::UPDATE_MESSAGE);
        }

        if ($rbacService->findItem(Permission::CREATE_MESSAGE)) {
            $rbacService->removePermission(Permission::CREATE_MESSAGE);
        }

        if ($rbacService->findItem(Permission::RBAC)) {
            $rbacService->removePermission(Permission::RBAC);
        }

        if ($rbacService->findItem(Permission::USER)) {
            $rbacService->removePermission(Permission::USER);
        }

        if ($rbacService->findRole(Permission::SIMPLE_USER)) {
            $rbacService->removeRole(Permission::SIMPLE_USER);
        }

        if ($rbacService->findRole(Permission::ADMIN)) {
            $rbacService->removeRole(Permission::ADMIN);
        }

        return true;
    }
}
