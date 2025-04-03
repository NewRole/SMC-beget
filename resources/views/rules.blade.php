@extends('layouts.layout')

@section('title', 'Правила')

@section('content')
    <section class="mafia-rules">
        <h1 class="section-title">Классическая спортивная мафия</h1>
        <div class="container">


            <div class="rules-grid">
                <!-- Блок с общим описанием -->
                <div class="rule-card intro-card">
                    <div class="rule-icon">🎯</div>
                    <h2>Интеллектуальный спорт</h2>
                    <p>Спортивная мафия - командные шахматы нового поколения. Развивает:</p>
                    <ul class="skills-list">
                        <li>Аналитическое мышление</li>
                        <li>Стратегическое планирование</li>
                        <li>Навыки аргументации</li>
                        <li>Коммуникативные способности</li>
                        <li>Логику и дедукцию</li>
                    </ul>
                </div>

                <!-- Состав и роли -->
                <div class="rule-card">
                    <div class="rule-icon">👥</div>
                    <h3>Состав участников</h3>
                    <div class="role-breakdown">
                        <div class="team mafia">
                            <h4>Команда мафии (3 игрока):</h4>
                            <ul>
                                <li>Дон</li>
                                <li>2 мафиози</li>
                            </ul>
                        </div>
                        <div class="team civilians">
                            <h4>Команда мирных (7 игроков):</h4>
                            <ul>
                                <li>Шериф</li>
                                <li>6 мирных жителей</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Основные правила -->
                <div class="rule-card">
                    <div class="rule-icon">📜</div>
                    <h3>Ключевые правила</h3>
                    <div class="rules-list">
                        <div class="rule-item">
                            <span class="rule-number">1</span>
                            <p>Строгий регламент выступлений - 1 минута на игрока без прерываний</p>
                        </div>
                        <div class="rule-item">
                            <span class="rule-number">2</span>
                            <p>Система фолов:
                            <ul class="foul-system">
                                <li>3 фола → 10 секунд на выступление</li>
                                <li>4 фола → удаление из игры</li>
                            </ul>
                            </p>
                        </div>
                        <div class="rule-item">
                            <span class="rule-number">3</span>
                            <p>Особенности стрельбы мафии:
                                <br>Одно ночное пробуждение,
                                <br>"Слепой" выстрел
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Турнирная система -->
                <div class="rule-card">
                    <div class="rule-icon">🏆</div>
                    <h3>Турнирный формат</h3>
                    <div class="tournament-system">
                        <div class="trophy-levels">
                            <div class="trophy">
                                <div class="cup">🏆</div>
                                <p>Внутриклубные турниры</p>
                            </div>
                            <div class="trophy">
                                <div class="cup">🌏</div>
                                <p>Международные чемпионаты</p>
                            </div>
                        </div>
                        <p class="rating-system">
                            Система рейтинга ELO для объективной оценки навыков
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

