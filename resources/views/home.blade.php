@extends('layouts.layout')

@section('title', 'Вход выполнен!')

@section('content')
    <div class="auth-container">
        <h2>Добро пожаловать в ваш аккаунт!</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <p>{{ __('Вы успешно вошли в систему!') }}</p>
    </div>
@endsection
