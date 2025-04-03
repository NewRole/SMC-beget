@extends('layouts.layout')

@section('title', 'Smile Mafia Club')

@section('content')
    <div class="auth-container">
        <h2>Подтвердите свой адрес электронной почты</h2>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('На ваш электронный адрес отправлена новая ссылка для подтверждения.') }}
            </div>
        @endif

        <p>{{ __('Перед тем как продолжить, пожалуйста, проверьте свою почту для подтверждения.') }}</p>
        <p>{{ __('Если вы не получили письмо') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn">Запросить новую ссылку</button>
        </form>
        </p>
    </div>
@endsection
