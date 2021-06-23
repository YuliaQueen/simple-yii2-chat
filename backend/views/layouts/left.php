<?php
/* @var string $directoryAsset */

use backend\modules\rbac\helpers\RbacHelper;
use backend\modules\rbac\models\enums\Permission;

?>

<aside class="main-sidebar">
    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Главная', 'icon' => 'globe', 'url' => ['/']],
                    [
                        'label' => 'Пользователи',
                        'icon' => 'user',
                        'url' => '#',
                        'visible' => RbacHelper::checkAccess([Permission::USER, Permission::RBAC]),
                        'items' => [
                            [
                                'label' => "Список пользователей",
                                'icon' => 'users',
                                'url' => ['/user'],
                                'active' => Yii::$app->controller->id === 'user',
                                'visible' => RbacHelper::checkAccess([Permission::USER]),
                            ],
                            [
                                'label' => "Управление правами",
                                'icon' => 'filter',
                                'url' => ['/rbac/assignment'],
                                'active' => Yii::$app->controller->id === 'assignment' || Yii::$app->controller->id === 'role',
                                'visible' => RbacHelper::checkAccess([Permission::RBAC]),
                            ],
                        ],
                    ],
                    [
                        'label' => 'Сообщения',
                        'icon' => 'user',
                        'url' => '#',
                        'visible' => RbacHelper::checkAccess([Permission::UPDATE_MESSAGE]),
                        'items' => [
                            [
                                'label' => "Все сообщения",
                                'icon' => 'filter',
                                'url' => ['/message'],
                                'active' => Yii::$app->controller->id === 'message',
                                'visible' => RbacHelper::checkAccess([Permission::UPDATE_MESSAGE]),
                            ],
                        ],
                    ],
                ],
            ],
        ) ?>
    </section>
</aside>
