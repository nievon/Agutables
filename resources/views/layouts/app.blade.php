<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{url('style/style.css')}}">
    <link rel="icon" type="image/x-icon" href="{{url('/image/favicon.ico')}}">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body style="background: #f0f0f0;">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{url('/image/logoheader.png')}}" alt="Agutable" style="width: 6rem;">
                    <!-- <span style="color: white; font-size: 24px;">{{ config('app.name', 'Laravel') }}</span> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li><a class="nav-link text-light" style="font-size: 1.25rem;" href="{{ route('index') }}#about">О нас</a></li>
                        @if(Auth::check())
                        <li><a class="nav-link text-light" style="font-size: 1.25rem;" href="{{route('books.index')}}">Мои таблицы</a></li>
                        <li><a class="nav-link text-light" style="font-size: 1.25rem;" href="{{route('books.sharedWithMe')}}">Совместные таблицы</a></li>
                        @endif
                        @if(!Auth::check() || !Auth::user()->isAdmin())
                        @else
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('adminpanel') }}" style="color: white; font-size: 1.25rem;">Панель Админа</a>
                        </li>
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login') && Route::currentRouteName() !== 'login')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color: white; font-size: 1.25rem;">Вход на сайт</a>
                        </li>
                        @elseif(!Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" style="color: white; font-size: 1.25rem;">Регистрация</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" style="font-size: 1.25rem; color: white;" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style=" background: rgb(25 135 84); font-size: 1.25rem;">
                                <a class="nav-link m-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" style="color: white; font-size: 1.25rem;">
                                    Выход
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="">
            @yield('content')
        </main>

    </div>
    <footer class="footer mt-4">
        <div class="container d-flex justify-content-center">
            <p class="mb-0" style="font-size: 18px;">&copy; 2024 Agutables. Все права защищены.</p>
        </div>
    </footer>
</body>

</html>