@extends("layouts.layout")

@section("title", "Smile Mafia Club")

@section("content")
    <div class="auth-container">
        @auth
            <!-- Если пользователь уже авторизован, показываем его имя -->
            <h2>Привет, {{ Auth::user()->name }}!</h2>
            <a href="{{ route('logout') }}" class="btn">Выйти</a>
        @else
            <!-- Если пользователь не авторизован, показываем форму регистрации -->
            <h2>Регистрация</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Имя" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <input type="password" name="password_confirmation" placeholder="Повторите пароль" required>
                <button type="submit">Зарегистрироваться</button>
            </form>

            <h3>Уже есть аккаунт?</h3>
            <a href="{{ route('login') }}">Войти</a>
        @endauth
    </div>
@endsection
