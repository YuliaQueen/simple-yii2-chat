## Simple Yii2-chat

Простой MVC-чат на фреймворке Yii2

РАЗВОРАЧИВАНИЕ ПРОЕКТА ЛОКАЛЬНО С ИСПОЛЬЗОВАНИЕМ VAGRANT И VM VIRTUALBOX
------------------

1. Переименовать vagrant-local.example.yml в vagrant-local.yml
   * в файле vagrant-local.yml прописать токен GitHub
2. В терминале выполнить команду `vagrant up`
3. После установки виртуальной машины выполнить команду `vagrant ssh` и перейти в папку `app`   
4. Выполнить `composer update`, если потребуется
5. Применить миграции `php yii migrate`
6. Создать администратора при помощи консольной команды `php yii admin/create`

УПРАВЛЕНИЕ РОЛЯМИ И РАЗРЕШЕНИЯМИ В ПРОЕКТЕ
-------------------
* Все разрешения создаются через миграции. В проекте изначально есть роли Admin и Simle User, а также разрешения на управление правами, пользователями и сообщениями.
* У обычного пользователя есть разрешение только на написание сообщений
* У администратора есть все права
* Создавать роли можно в админ-панели
* Назначать разрешения можно в админ-панели

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
