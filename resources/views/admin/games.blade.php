@extends('layouts.layout')

@section('title', 'Управление играми')

@section('content')
    <div class="admin-container">
        <h1>Управление играми</h1>

        <a href="{{ route('admin.games.create') }}" class="btn btn-primary">Добавить игру</a>

        <div class="games-list mt-4">
            @forelse($games as $game)
            <div class="game-item card mb-3">
                <div class="card-body">
                    <h3>{{ $game->type }}</h3>
                    <p>Дата: {{ $game->date->format('d.m.Y') }}</p>
                    <p>Время: {{ $game->time }}</p>
                    <p>Место: {{ $game->location }}</p>

                    <div class="mt-2">
                        <a href="{{ route('admin.games.edit', $game) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Удалить эту игру?')">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
                <div class="empty-state">
                    Нет доступных игр
                </div>
            @endforelse
        </div>
    </div>
@endsection
