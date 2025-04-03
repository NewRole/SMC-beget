@extends("layouts.layout")

@section("title", "Smile Mafia Club")

@section("content")
    <div class="auth-container">
        @auth
            <!-- Если пользователь авторизован, отображаем его имя -->
            <h2>Привет, {{ Auth::user()->name }}!</h2>
            <a href="{{ route('logout') }}" class="btn">Выйти</a>
        @else
            <!-- Если пользователь не авторизован, показываем форму входа -->
            <h2>Вход</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <button type="submit">Войти</button>
            </form>

            <h3>Еще нет аккаунта?</h3>
            <a href="{{ route('register') }}">Регистрация</a>
        @endauth
    </div>
@endsection
