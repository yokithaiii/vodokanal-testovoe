# Описание проекта

Цель задания: разработать веб-приложение для анализа и визуализации данных, собираемых с внешнего источника.
<br>
1. Backend:
   - ✔️ Используйте Laravel для создания REST API.
   - ✔️ Разработайте функционал для сбора данных из внешних источников. (data.csv)
   - ✔️ Реализуйте обработку и агрегацию собранных данных
2. Frontend:
   - ✔️ Используйте Vue.js для создания интерфейса, позволяющего пользователям взаимодействовать с данными.
   - ✔️ Разработайте дашборд для визуализации данных с использованием таблиц.
   - ✔️ Реализуйте фильтрацию, сортировку данных и настройку параметров отображения.
3. База данных:
   - ✔️ Используйте MySQL для хранения собранных данных и пользовательских настроек.
   - ✔️ Оптимизируйте структуру базы данных для эффективной работы с большими объемами данных.
4. Веб-сервер и Docker:
   - ✔️ Настройте Nginx в качестве веб-сервера.
   - ✔️ Контейнеризуйте приложение с помощью Docker (включая Laravel, Vue, Nginx, MySQL).
5. Дополнительные задания:
   - ❌ Реализуйте механизмы кеширования данных для ускорения загрузки дашборда.
   - ✔️ Внедрите возможность экспорта отчетов и данных в различных форматах (CSV).
   - ❌ Внедрите возможность экспорта отчетов и данных в различных форматах (PDF, XLSX, DOC).
   - ❌ Обеспечьте аутентификацию и авторизацию пользователей.

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
