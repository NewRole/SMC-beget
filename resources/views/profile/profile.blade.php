@extends("layouts.layout")

@section("title", "Smile Mafia Club")

@section("content")
    <div class="profile-container">
        <h2>Личный кабинет</h2>
        <p>Добро пожаловать, {{ Auth::user()->name }}!</p>
        <p>Email: {{ Auth::user()->email }}</p>
        <p>Статус:
            <span class="status-badge {{ Auth::user()->userstatus }}">
        {{ Auth::user()->userstatus }}
    </span>
        </p>

        <div class="profile-details">
            <p>Здесь вы можете увидеть дополнительную информацию о вашем аккаунте и настроить его.</p>
            <a href="{{ route('profile.edit') }}" class="btn">Редактировать профиль</a>
        </div>

        <a href="{{ route('logout') }}" class="btn logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Выйти
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
@endsection
