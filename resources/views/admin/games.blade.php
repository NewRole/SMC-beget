@extends('layouts.layout')

@section('title', 'Управление играми')

@section('content')
    <div class="admin-container">
        <h1>Управление играми</h1>

        <div class="games-list">
            @forelse($games as $game)
                <div class="game-item">
                    <h3>{{ $game->type }}</h3>
                    <p>Дата: {{ $game->date->format('d.m.Y') }}</p>
                    <p>Время: {{ $game->time }}</p>
                    <p>Место: {{ $game->location }}</p>
                </div>
            @empty
                <div class="empty-state">
                    Нет доступных игр для управления
                </div>
            @endforelse
        </div>
    </div>
@endsection
