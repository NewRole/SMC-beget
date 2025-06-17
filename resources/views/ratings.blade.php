@extends("layouts.layout")

@section("title", "Smile Mafia Club")
@push('styles')
    <style>


        /* Вкладки */
        .nav {
            display: flex;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
            padding-bottom: 10px;
        }
        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
        }
        .nav-tabs .nav-item {
            margin-bottom: 1px;
        }
        .nav-tabs .nav-link {
            border: 1px solid transparent;
            border-radius: 0.25em;
            padding: 0.5rem 1rem;

        }
        .nav-tabs .nav-link:hover {
            border-color: #e9ecef #e9ecef #dee2e6;
        }
        .nav-tabs .nav-link.active {
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }

        /* Табы */
        .tab-content > .tab-pane {
            display: none;
        }
        .tab-content > .active {
            display: block;
        }
        .fade {
            transition: opacity 0.15s linear;
        }
        .fade:not(.show) {
            opacity: 0;
        }

        /* Таблицы */
        .table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .table-hover tbody tr:hover {

            background-color: rgba(0, 0, 0, 0.075);
        }
        .table-dark {
            color: #fff;
            background-color: #343a40;
        }
        .table-dark th,
        .table-dark td,
        .table-dark thead th {
            border-color: #000000;
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Кастомная реализация табов
            const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');

            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Скрыть все табы
                    document.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.classList.remove('show', 'active');
                    });

                    // Деактивировать все ссылки
                    document.querySelectorAll('.nav-link').forEach(navLink => {
                        navLink.classList.remove('active');
                    });

                    // Показать выбранный таб
                    const target = document.querySelector(this.getAttribute('data-bs-target'));
                    target.classList.add('show', 'active');

                    // Активировать текущую ссылку
                    this.classList.add('active');
                });
            });
        });
    </script>
@endpush
@section("content")

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Рейтинг игроков Smile Mafia Club</h1>
            @if($lastUpdate)
                <div class="text-muted">
                    Обновлено: {{ $lastUpdate->format('d.m.Y H:i') }}
                </div>
            @endif
        </div>

        <!-- Вкладки с названиями таблиц -->
        <div class="tabs-container mb-4">
            <div class="tabs-wrapper">
                <ul class="nav nav-tabs" id="ratingTabs" role="tablist">
                    @foreach($tables as $tableName => $tableData)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="tab-{{ $loop->index }}"
                                    data-bs-toggle="tab"
                                    data-bs-target="#content-{{ $loop->index }}"
                                    type="button"
                                    role="tab">
                                {{ $tableName }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Содержимое вкладок -->
        <div class="tab-content" id="ratingTabsContent">
            @foreach($tables as $tableName => $tableData)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                     id="content-{{ $loop->index }}"
                     role="tabpanel"
                     aria-labelledby="tab-{{ $loop->index }}">

                    <div class="table-header mb-3">
                        <h3 class="text-center" style="color: #d63384; text-shadow: 0 0 10px rgba(214,51,132,0.5);">
                            {{ $tableName }}
                        </h3>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                            <tr>
                                <th>Место</th>
                                <th>Игрок</th>
                                <th>ТКМ</th>
                                <th>Игры</th>
                                <th>Победы</th>
                                <th>Поражения</th>
                                <th>Винрейт</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tableData as $player)
                                <tr>
                                    <td>{{ $player['place'] }}</td>
                                    <td>{{ $player['name'] }}</td>
                                    <td>{{ number_format($player['tkm'], 2) }}</td>
                                    <td>{{ $player['games_played'] }}</td>
                                    <td>{{ $player['wins'] }}</td>
                                    <td>{{ $player['losses'] }}</td>
                                    <td>{{ number_format($player['win_rate'], 2) }}%</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
