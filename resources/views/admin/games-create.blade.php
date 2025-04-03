@extends('layouts.layout')

@section('title', 'Добавить игру')

@section('content')
    <div class="admin-container">
        <h1>Добавить новую игру</h1>

        <form action="{{ route('admin.games.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Тип игры:</label>
                <input type="text" name="type" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Дата:</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Время:</label>
                <input type="time" name="time" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Место:</label>
                <input type="text" name="location" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.games') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
