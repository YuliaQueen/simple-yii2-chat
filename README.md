## Simple Yii2-chat

Простой MVC-чат на фреймворке Yii2

РАЗВОРАЧИВАНИЕ ПРОЕКТА ЛОКАЛЬНО 
------------------

1. Переименовать vagrant-local.example.yml в vagrant-local.yml
2. В терминале выполнить команду `vagrant up`
3. После установки виртуальной машины выполнить команду `vagrant ssh` и перейти в папку `app`   
4. Выполнить `composer update`, если потребуется
5. Применить миграции `php yii migrate`
6. Создать администратора при помощи консольной команды `php yii admin/create`


СТРУКТУРА ПРОЕКТА
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
