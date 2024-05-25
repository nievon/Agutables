# Agutables

Agutables — это веб-приложение, разработанное на Laravel, которое представляет собой онлайн-копию Excel. Оно позволяет пользователям загружать, редактировать и выгружать Excel файлы прямо через веб-интерфейс.

## Основные возможности

- **Загрузка и выгрузка файлов Excel**: Легко загружайте свои Excel файлы и выгружайте их после редактирования.
- **Редактирование данных**: Интуитивно понятный интерфейс для редактирования данных в таблицах, похожий на Excel.
- **Сохранение изменений в реальном времени**: Внесенные изменения сохраняются в реальном времени, благодаря использованию AJAX.
- **Просмотр данных**: Возможность просмотра данных без редактирования.
- **Ограничение доступа**: Возможность ограничивать редактирование определенных ячеек или строк.

## Технологии

- **Backend**: Laravel — мощный PHP-фреймворк для веб-приложений.
- **Frontend**: HTML, CSS, Bootstrap, JavaScript, jQuery — для создания отзывчивого и интерактивного пользовательского интерфейса.
- **Excel**: [maatwebsite/excel](https://github.com/Maatwebsite/Laravel-Excel) — библиотека для работы с файлами Excel на Laravel.

## Установка

1. Клонируйте репозиторий:
    ```bash
    git clone https://github.com/nievon/agutables.git
    ```

2. Перейдите в директорию проекта:
    ```bash
    cd agutables
    ```

3. Запустите локальный сервер разработки:
    ```bash
    php artisan serve
    ```

## Использование

1. Перейдите на `http://localhost:8000` в вашем веб-браузере.
2. Зарегистрируйтесь или войдите в систему.
3. Загрузите Excel файл, который вы хотите редактировать.
4. Внесите необходимые изменения в таблицу.
5. Сохраните изменения и выгрузите обновленный файл.

## Вклад в проект

Если вы хотите внести свой вклад в развитие проекта, вы можете создать форк репозитория и отправить запрос на слияние. Мы приветствуем все предложения и исправления ошибок.

## Лицензия

Этот проект лицензирован на условиях лицензии MIT. 

---

Agutables — ваш онлайн-инструмент для работы с Excel файлами, прямо в веб-браузере!
