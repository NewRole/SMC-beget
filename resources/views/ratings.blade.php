@extends("layouts.layout")

@section("title", "Smile Mafia Club")

@section("content")
    <div class="container">
        @if($error)
            <div class="alert alert-danger">
                {{ $error }}
                <p>Попробуйте обновить страницу позже</p>
                <button onclick="window.location.reload()" class="btn-retry">
                    Попробовать снова
                </button>
            </div>
        @else
            <h2>{{ $caption }}</h2>
            <p class="text-muted">Последнее обновление: {{ $updateTime }}</p>
            <p class="text-info">Количество игр за период: {{ $count }}</p>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <!-- Основная информация -->
                        <th>ID</th>
                        <th>Никнейм</th>
                        <th>Игр сыграно</th>
                        <th>Винрейт</th>

                        <!-- Статистика побед -->
                        <th>Побед всего</th>
                        <th>Побед Шериф</th>
                        <th>Побед Мирный</th>
                        <th>Побед Дон</th>
                        <th>Побед Мафия</th>

                        <!-- Статистика поражений -->
                        <th>Поражений всего</th>
                        <th>Пораж. Шериф</th>
                        <th>Пораж. Мирный</th>
                        <th>Пораж. Дон</th>
                        <th>Пораж. Мафия</th>

                        <!-- Баллы и коэффициенты -->
                        <th>СрДБ</th>
                        <th>СрБ</th>
                        <th>ОМИ</th>
                        <th>КМИ</th>
                        <th>МЛХ</th>
                        <th>ККИ</th>
                        <th>САФ</th>
                        <th>ТКМ</th>

                        <!-- Дополнительные показатели -->
                        <th>Штрафы</th>
                        <th>Компенсации</th>
                        <th>Ущерб</th>
                        <th>Фолы</th>
                        <th>СмДБ</th>
                        <th>ДШ</th>
                        <th>КЛХ</th>

                        <!-- Дополнительные баллы -->
                        <th>ДБ мирный</th>
                        <th>ДБ мафия</th>
                        <th>ДБ шериф</th>
                        <th>ДБ дон</th>

                        <!-- Лучшие ходы -->
                        <th>2 мафии</th>
                        <th>3 мафии</th>
                        <th>3 мирных</th>

                        <!-- Слоты -->
                        <th>1 слот</th>
                        <th>4 слот</th>
                        <th>Первые убийства</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($players as $player)
                        <tr>
                            <!-- Основная информация -->
                            <td>{{ $player['UserID'] }}</td>
                            <td>{{ $player['Nick'] }}</td>
                            <td class="text-center">{{ $player['KI'] }}</td>
                            <td class="text-success">{{ $player['VR'] }}%</td>

                            <!-- Победы -->
                            <td class="text-success">{{ $player['Kpb'] }}</td>
                            <td>{{ $player['WinSheriff'] }}</td>
                            <td>{{ $player['WinRed'] }}</td>
                            <td>{{ $player['WinDon'] }}</td>
                            <td>{{ $player['WinBlack'] }}</td>

                            <!-- Поражения -->
                            <td class="text-danger">{{ $player['Kpr'] }}</td>
                            <td>{{ $player['LosingSheriff'] }}</td>
                            <td>{{ $player['LosingRed'] }}</td>
                            <td>{{ $player['LosingDon'] }}</td>
                            <td>{{ $player['LosingBlack'] }}</td>

                            <!-- Коэффициенты -->
                            <td>{{ $player['SrDB'] }}</td>
                            <td>{{ $player['SrB'] }}</td>
                            <td>{{ $player['OMI'] }}</td>
                            <td>{{ $player['KMI'] }}</td>
                            <td>{{ $player['MLH'] }}</td>
                            <td>{{ $player['KKI'] }}</td>
                            <td>{{ $player['SAF'] }}</td>
                            <td>{{ $player['TKM'] }}</td>

                            <!-- Штрафы и ущерб -->
                            <td class="text-danger">{{ $player['SH'] }}</td>
                            <td>{{ $player['K'] }}</td>
                            <td>{{ $player['U'] }}</td>
                            <td>{{ $player['F'] }}</td>
                            <td>{{ $player['SmDB'] }}</td>
                            <td>{{ $player['DB_SH'] }}</td>
                            <td>{{ $player['KLH'] }}</td>

                            <!-- Доп. баллы -->
                            <td>{{ $player['EPmr'] }}</td>
                            <td>{{ $player['EPmf'] }}</td>
                            <td>{{ $player['EPsh'] }}</td>
                            <td>{{ $player['EPd'] }}</td>

                            <!-- Лучшие ходы -->
                            <td>{{ $player['bm_2black'] }}</td>
                            <td>{{ $player['bm_3black'] }}</td>
                            <td>{{ $player['bm_3red'] }}</td>

                            <!-- Слоты -->
                            <td>{{ $player['p1'] }}</td>
                            <td>{{ $player['p4'] }}</td>
                            <td>{{ $player['fs'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@section('styles')
    <style>
        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }

        .table {
            min-width: 1500px;
            font-size: 0.9rem;
        }

        th {
            white-space: nowrap;
            background-color: #2d3748;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        td {
            vertical-align: middle;
            text-align: center;
        }

        .text-success {
            font-weight: bold;
            color: #28a745!important;
        }

        .text-danger {
            font-weight: bold;
            color: #dc3545!important;
        }

        .text-center {
            text-align: center!important;
        }

        .text-muted {
            color: #6c757d!important;
            font-size: 0.9rem;
        }

        .btn-retry {
            background: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 1rem;
        }
    </style>
@endsection
