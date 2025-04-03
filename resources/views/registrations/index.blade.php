@extends('layouts.layout')

@section('title', 'Мои записи')

@section('content')
    <section class="registrations-section">
        <div class="section-content">
            <h2>Мои записи на игры</h2>

            @if($registrations->isEmpty())
                <p>У вас нет активных записей</p>
            @else
                <div class="registrations-list">
                    @foreach($registrations as $registration)
                        <div class="registration-card">
                            <div class="game-info">
                                <h3>{{ $registration->game->type }}</h3>
                                <p>Дата: {{ $registration->game->date->format('d.m.Y') }}</p>
                                <p>Время: {{ $registration->game->time }}</p>
                                <p>Локация: {{ $registration->game->location }}</p>
                            </div>
                            <div class="registration-actions">
                                <form action="{{ route('registrations.destroy', $registration) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-cancel">
                                        Отменить запись
                                    </button>
                                </form>
{{--                                <div class="registration-status">--}}
{{--                                    Статус: {{ $registration->status }}--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
