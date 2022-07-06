<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="ksSuYKnA4EytAfis4gZ1z98TxO8rZRWX5zGgktba">

    <title>
        @auth
            @adminАдминка@else Заказы @endadmin
            @yield('title')
        @else
            Авторизация/Регистрация
        @endauth
    </title>

    <!-- Scripts -->
    <script src="http://laravel-diplom-1.rdavydov.ru/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                Вернуться на сайт
            </a>

            <div id="navbar" class="collapse navbar-collapse">
                @auth
                    @admin
                        <ul class="nav navbar-nav">
                            <li @routeactive('products.index')><a href="{{ route('products.index') }}">Товары</a></li>
                            <li @routeactive('categor*')><a href="{{ route('categories.index') }}">Категории</a></li>
                            <li @routeactive('home')><a href="{{ route('home') }}">Заказы</a></li>
                        </ul>
                    @endadmin
                @endauth
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('get-logout') }}">Выйти</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">@yield('title')</div>

                <div class="card-body">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
