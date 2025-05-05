@extends('layouts.layout')

@section('title', 'Добавить игру')

@section('content')
    <div class="admin-container">
        <h1>Добавить новую игру</h1>

        <form action="{{ route('admin.games.store') }}" method="POST">
            @csrf

            <!-- Тип игры -->
            <div class="form-group">
                <label>Тип игры:</label>
                <select name="type" class="form-control" required>
                    <option value="мафия">Мафия</option>
                    <option value="бункер">Бункер</option>
                </select>
                @error('type')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Дата -->
            <div class="form-group">
                <label>Дата:</label>
                <input type="date"
                       name="date"
                       class="form-control"
                       required
                       min="{{ now()->toDateString() }}"
                       value="{{ old('date') }}">
                @error('date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Время -->
            <div class="form-group">
                <label>Время:</label>
                <select name="time" class="form-control" required>
                    @foreach(['19:30', '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00'] as $time)
                        <option value="{{ $time }}" {{ old('time') == $time ? 'selected' : '' }}>
                            {{ $time }}
                        </option>
                    @endforeach
                </select>
                @error('time')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Место -->
            <div class="form-group">
                <label>Место:</label>
                <select name="location" class="form-control" required>
                    <option value="Центральный зал" {{ old('location') == 'Центральный зал' ? 'selected' : '' }}>
                        Центральный зал
                    </option>
                    <option value="Дальний зал" {{ old('location') == 'Дальний зал' ? 'selected' : '' }}>
                        Дальний зал
                    </option>
                    <option value="ДнД зал" {{ old('location') == 'ДнД зал' ? 'selected' : '' }}>
                        ДнД зал
                    </option>
                </select>
                @error('location')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Количество мест:</label>
                <input type="number"
                       name="max_players"
                       class="form-control"
                       min="1"
                       value="{{ old('max_players', 10) }}"
                       required>
                @error('max_players')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.games') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
