<?php

use backend\modules\rbac\RbacService;
use yii\rbac\DbManager;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => DbManager::class,
        ],
        'rbacService' => [
            'class' => RbacService::class,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
