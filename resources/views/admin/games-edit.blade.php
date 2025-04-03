@extends('layouts.layout')

@section('title', 'Редактировать игру')

@section('content')
    <div class="admin-container">
        <h1>Редактировать игру</h1>

        <form action="{{ route('admin.games.update', $game) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Тип игры:</label>
                <input type="text" name="type" class="form-control" value="{{ $game->type }}" required>
            </div>

            <div class="form-group">
                <label>Дата:</label>
                <input type="date" name="date" class="form-control"
                       value="{{ $game->date->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label>Время:</label>
                <input type="time" name="time" class="form-control" value="{{ $game->time }}" required>
            </div>

            <div class="form-group">
                <label>Место:</label>
                <input type="text" name="location" class="form-control" value="{{ $game->location }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.games') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
