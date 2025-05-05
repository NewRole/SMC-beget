<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Neucha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('sass/app.scss') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/headfoot.css') }}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{asset('css/games.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <title>@yield("title")</title>
</head>
<body>
<header>
{{--контейнер--}}
    <div class="container">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('images/logo.jpg') }}" alt="Логотип">
            </a>
        </div>


        <!-- Навигация -->
        <div class="row">
            <div class="nav-item">
                <a class="nav-link" href="{{ route('games.index') }}">Игры</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="{{route('ratings')}}">Рейтинг</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="{{route('rules')}}">Правила игры</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">Услуги</a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">Магазин</a>
            </div>

            @auth
                <div class="nav-item dropdown">
                    <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('profile') }}">Личный кабинет</a>
                        <a class="dropdown-item" href="{{ route('registrations.index') }}">
                            Мои записи ({{ Auth::user()->activeRegistrationsCount() }})
                        </a>

                        @if(Auth::user()->isAdmin())
                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">Администрирование</h6>
                            <a class="dropdown-item" href="{{ route('admin.games') }}">Управление играми</a>
                            <a class="dropdown-item" href="{{ route('admin.users') }}">Пользователи</a>
                        @endif

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @else <div class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                  </div>
                </div>
            @endauth
        </div>
    </div>
</header>

<main>
