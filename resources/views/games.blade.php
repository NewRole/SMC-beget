@extends("layouts.layout")

@section("title", "Игры")

@section("content")
    <section id="games" class="games-section">
        <div class="section-content">
            <h2>Расписание игр</h2>

            <!-- Фильтр и табы -->
            <div class="games-filter">
                <select id="gameTypeFilter" class="filter-select">
                    <option value="all">Все игры</option>
                    @foreach(collect($games)->collapse()->pluck('type')->unique() as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="games-tabs">
                <button class="tab-btn active" data-category="today">Сегодня</button>
                <button class="tab-btn" data-category="upcoming">Ближайшие</button>
                <button class="tab-btn" data-category="past">Архив</button>
            </div>

            <!-- Контейнеры для игр -->
            <div class="games-container">
                @foreach(['today', 'upcoming', 'past'] as $category)  <!-- Добавлен внешний цикл -->
                <div class="game-category {{ $loop->first ? 'active' : '' }}" data-category="{{ $category }}">
                    <div class="games-grid">
                        @foreach($games[$category] ?? [] as $game)
                            <div class="game-card" data-game-id="{{ $game->id }}">
                                <div class="game-header">
                                    <span class="game-type">{{ $game->type }}</span>
                                    <span class="game-date">
                                        {{ $game->date->format('d.m.Y') }}
                                        {{ \Carbon\Carbon::parse($game->time)->format('H:i') }}

                                        @if($game->full_date_time)
                                            ({{ $game->full_date_time->diffForHumans() }})
                                        @else
                                            (Некорректная дата)
                                        @endif
                                    </span>
                                </div>
                                <div class="game-body">
                                    <p>📍 {{ $game->location }}</p>

                                    @if($category !== 'past')
                                        @php
                                            $available = max(0, $game->max_players - $game->registrations_count);
                                            $isRegistered = auth()->check() && auth()->user()->registrations->contains('game_id', $game->id);

                                            if (!auth()->check()) {
                                                $buttonText = 'Войдите для записи';
                                                $disabled = true;
                                            } else {
                                                $buttonText = $isRegistered
                                                    ? 'Записан'
                                                    : ($available > 0 ? "Записаться ($available)" : 'Мест нет');
                                                $disabled = $isRegistered || ($available <= 0);
                                            }
                                        @endphp

                                        <button class="signup-button"
                                                data-game-id="{{ $game->id }}"
                                            {{ $disabled ? 'disabled' : '' }}>
                                            {{ $buttonText }}
                                        </button>
                                    @else
                                        <div class="game-archive-label">Игра завершена</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Обработчик табов
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    // Удаляем активный класс у всех кнопок
                    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                    // Добавляем активный класс текущей кнопке
                    this.classList.add('active');

                    // Получаем категорию
                    const category = this.dataset.category;

                    // Скрываем все категории
                    document.querySelectorAll('.game-category').forEach(cat => {
                        cat.classList.remove('active');
                    });

                    // Показываем выбранную категорию
                    const targetCategory = document.querySelector(`.game-category[data-category="${category}"]`);
                    if(targetCategory) {
                        targetCategory.classList.add('active');
                    }
                });
            });

            // Обработчик записи
            document.addEventListener('click', async (e) => {
                if (e.target.classList.contains('signup-button')) {
                    const gameId = e.target.dataset.gameId;
                    const button = e.target;

                    try {
                        const response = await fetch('/registrations', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ game_id: gameId })
                        });

                        if (response.ok) {
                            button.textContent = 'Записан';
                            button.disabled = true;
                        } else {
                            alert('Ошибка записи');
                        }
                    } catch (error) {
                        console.error('Ошибка:', error);
                        alert('Ошибка сети');
                    }
                }
            });

            // Фильтрация
            document.getElementById('gameTypeFilter').addEventListener('change', function() {
                const filter = this.value;
                document.querySelectorAll('.game-card').forEach(card => {
                    card.style.display = filter === 'all' || card.querySelector('.game-type').textContent === filter
                        ? 'block'
                        : 'none';
                });
            });
        });
        document.addEventListener('click', async (e) => {
            if (e.target.classList.contains('signup-button')) {
                const button = e.target;
                button.disabled = true;
                button.textContent = 'Загрузка...';

                try {
                    const response = await fetch('/registrations', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            game_id: button.dataset.gameId
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.error || 'Неизвестная ошибка');
                    }

                    button.textContent = 'Записан';
                    button.style.backgroundColor = '#4CAF50';

                } catch (error) {
                    console.error('Ошибка:', error);
                    alert(error.message);
                    button.textContent = 'Записаться';
                    button.disabled = false;
                }
            }
        });
    </script>
@endpush
