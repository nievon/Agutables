$(document).ready(function () {
    // Получаем URL-адрес AJAX-запроса из атрибута data
    var searchUrl = $('#searchUrl').data('url');

    // Событие при вводе текста в поле поиска
    $('#searchTerm').on('input', function () {
        var searchTerm = $(this).val();
        var $searchResults = $('#searchResults');

        // Отправляем AJAX запрос на сервер для поиска пользователей
        $.ajax({
            url: searchUrl, // Используем полученный URL-адрес
            method: 'GET',
            data: {
                searchTerm: searchTerm
            },
            success: function (response) {
                // Очищаем список результатов
                $searchResults.empty();

                // Проверяем, что response является массивом
                if (Array.isArray(response)) {
                    // Добавляем каждого найденного пользователя в список результатов
                    response.forEach(function (user) {
                        $searchResults.append('<option value="' + user.id + '">' + user.name + '</option>');
                    });

                    // Показываем список результатов
                    $searchResults.show();
                }
            },
            error: function (xhr, status, error) {
                console.error('Произошла ошибка при выполнении запроса', error);
            }
        });
    });

    // Событие при выборе пользователя из списка результатов
    $('#searchResults').on('click', 'option', function () {
        var selectedUserId = $(this).val();
        var selectedUserName = $(this).text();

        // Устанавливаем выбранное имя пользователя в поле поиска
        $('#searchTerm').val(selectedUserName);

        // Сохраняем выбранный ID пользователя в скрытом поле формы
        $('#selectedUser').val(selectedUserId);

        // Скрываем список результатов
        $('#searchResults').hide();
    });
});
