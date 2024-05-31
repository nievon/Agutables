<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доступ запрещен</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{url('/image/favicon.ico')}}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        .error-container {
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }
        .error-code {
            font-size: 10rem;
            font-weight: bold;
            color: #ff4c4c;
            text-shadow: 2px 2px #ffbcbc;
        }
        .error-message {
            font-size: 2rem;
            color: #333;
        }
        .home-button {
            margin-top: 30px;
            font-size: 1.2rem;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">403</div>
        <div class="error-message">У вас нет прав для доступа к этой странице.</div>
        <a href="{{ url('/') }}" class="btn btn-success home-button">Вернуться на главную</a>
    </div>
</body>
</html>
