@extends("layouts.layout")

@section("title", "Smile Mafia Club")

@section("content")
    <div class="main-container">
        <!-- Video Banner -->
        <section class="video-banner">
            <video autoplay muted loop id="mainVideo">
                <source src="{{ asset('videos/main-banner.mp4') }}" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
            <div class="banner-overlay">
                <h1>Добро пожаловать в Smile Mafia Club</h1>
                <p>Погрузитесь в мир интеллектуальных битв и незабываемых эмоций</p>
                <a href="{{ route('games.index') }}" class="cta-button">Присоединиться к игре</a>
            </div>
        </section>

        <section class="about-section">
            <div class="section-content">
                <h2>О нашем клубе</h2>
                <div class="about-grid">
                    <div class="about-card">
                        <i class="icon-group"></i>
                        <h3>1 год опыта</h3>
                        <p>Проведено более 1000 успешных игр</p>
                    </div>
                    <div class="about-card">
                        <i class="icon-scenario"></i>
                        <h3>Уникальные сценарии</h3>
                        <p>Авторские разработки наших ведущих</p>
                    </div>
                    <div class="about-card">
                        <i class="icon-location"></i>
                        <h3>4 зала</h3>
                        <p>Современные залы в центре города</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="serve">
                <h2>Наша команда</h2>
            <div class="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <img src="{{ asset('images/split.jpg') }}" alt="Smola">
                        <h3>Split</h3>
                        <p>Генеральный директор</p>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/Smola.jpg') }}" alt="Ice Hawk">
                        <h3>Смола</h3>
                        <p>Президент клуба</p>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/IceHawk.jpg') }}" alt="User 3">
                        <h3>Ice Hawk</h3>
                        <p>Вице-президент клуба</p>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/nosochek.jpg') }}" alt="User 4">
                        <h3>Nosochek</h3>
                        <p>Клиент-менеджер</p>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/samhaina.jpg') }}" alt="User 5">
                        <h3>Samhaina</h3>
                        <p>Ивентолог</p>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/geropon.jpg') }}" alt="User 6 ">
                        <h3>Geropon</h3>
                        <p>Ведущий городской мафии</p>
                    </div>
                </div>
                <button class="carousel-prev">&#10094;</button>
                <button class="carousel-next">&#10095;</button>
            </div>
        </div>
    </div>

    <section class="services-section">
        <div class="section-content">
            <h2>Наши услуги</h2>
            <div class="services-grid">
                <div class="service-card">
                    <h3>Корпоративные мероприятия</h3>
                    <ul>
                        <li>Тимбилдинги</li>
                        <li>Мотивационные игры</li>
                        <li>Тематические вечеринки</li>
                    </ul>
                </div>
                <div class="service-card">
                    <h3>Частные мероприятия</h3>
                    <ul>
                        <li>Дни рождения</li>
                        <li>Выпускные</li>
                        <li>Мальчишники/Девичники</li>
                    </ul>
                </div>
                <div class="service-card">
                    <h3>Особые форматы</h3>
                    <ul>
                        <li>Ночные игры</li>
                        <li>Турниры</li>
                        <li>Именные игры</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
