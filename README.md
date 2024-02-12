# Описание проекта

Проект Twutter был сделан на основе курсов по Laravel для закрепления
полученных знаний.
<br>
В проекте реализованы такие функционалы как:
- Авторизация/Регистрация пользователя
- CRUD постов
- Изменение данных пользователя (Имя, Email, Фотография)
- Подписка на пользователей и показ их постов
- Чат на вебсокете между пользователями
- Общий чат на подобии реддита с возможностью ответить пользователю/комментарию

# Установка и запуск

  Запустить проект в docker:
  
    docker-compose up -d

## Laravel

  Установить зависимости:

    docker compose exec backend composer install

  Сгенерировать ключ приложения:

    docker compose exec backend php artisan key:generate

  Выполнить миграции:

    docker compose exec backend php artisan migrate
    
  Выполнить команду импорта данных из .csv файлов:

    docker compose exec backend php artisan import:data

## Vue.js

  Установить зависимости:

    docker compose exec frontend npm install

  Собрать приложение:

    docker compose exec frontend npm run build
