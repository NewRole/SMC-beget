@extends("layouts.layout")

@section("title", "Smile Mafia Club")

@section("content")
    <div class="profile-container">
        <h2>Редактирование профиля</h2>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" required>
            </div>

            <div class="form-group">
                <label for="password">Новый пароль (оставьте пустым, если не хотите менять)</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Подтвердите пароль</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary">Обновить профиль</button>
        </form>
    </div>
@endsection
