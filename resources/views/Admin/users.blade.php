@extends('layouts.layout')

@section('title', 'Управление пользователями')

@section('content')
    <div class="admin-container">
        <h1>Управление пользователями</h1>

        <table class="users-table">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="status-badge {{ $user->userstatus }}">
                            {{ $user->userstatus }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.users.updateStatus', $user) }}" method="POST">
                            @csrf
                            <select name="userstatus" onchange="this.form.submit()">
                                <option value="Нет статуса" {{ $user->userstatus == 'Нет статуса' ? 'selected' : '' }}>Нет статуса</option>
                                <option value="Резидент" {{ $user->userstatus == 'Резидент' ? 'selected' : '' }}>Резидент</option>
{{--                                <option value="Клубная карта" {{ $user->userstatus == 'Клубная карта' ? 'selected' : '' }}>Клубная карта</option>--}}
                                <option value="Клиент-менеджер" {{$user->userstatus == 'Клиент-менеджер' ? 'selected' : ''}}>Клиент-менеджер</option>
                                <option value="Организатор"{{$user->userstatus == 'Организатор' ? 'selected' : ''}}>Организатор</option>
                                <option value="Член совета"{{$user->userstatus == 'Член совета' ? 'selected' : ''}}>Член совета</option>
                                <option value="Банитет"{{$user->userstatus == 'Банитет' ? 'selected' : ''}}>Банитет</option>
                                <option value="Вице-президент"{{$user->userstatus == 'Вице-президент' ? 'selected' : ''}}>Вице-президент</option>
                                <option value="Президент"{{$user->userstatus == 'Президент' ? 'selected' : ''}}>Президент</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
