</main>
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <!-- Контакты -->
            <div class="footer-section">
                <h4 class="footer-heading">Контакты</h4>
                <ul class="footer-list">
                    <li><a href="tel:+79635658954" class="footer-link">+7 (963) 565‒89‒53</a></li>
                    <li>Хабаровск, ул. Карла-Маркса 96а</li>
                    <li><a href="mailto:info@smilemafia.ru" class="footer-link">info@smilemafia.ru</a></li>
                </ul>
            </div>

            <!-- Часы работы -->
            <div class="footer-section">
                <h4 class="footer-heading">Часы работы</h4>
                <ul class="footer-list">
                    <li>Пн-Вс: 19:30 - 02:00</li>
                </ul>
            </div>

            <!-- Юр. информация -->
            <div class="footer-section">
                <h4 class="footer-heading">Компания</h4>
                <ul class="footer-list">
                    <li>ООО "Smile Mafia Club"</li>
                    <li>ИНН 2723256890</li>
                    <li>ОГРН 1202700033719</li>
                </ul>
            </div>

            <!-- Соцсети -->
            <div class="footer-section">
                <h4 class="footer-heading">Мы в соцсетях</h4>
                <div class="social-links">
                    <a href="#" class="social-link whatsapp">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.24-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/>
                        </svg>
                        WhatsApp
                    </a>
                    <a href="#" class="social-link telegram">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0m5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.16.16-.295.295-.605.295l.213-3.05 5.56-5.023c.242-.213-.054-.333-.373-.121l-6.869 4.326-2.96-.924c-.643-.204-.656-.643.136-.953l11.57-4.458c.538-.196 1.006.128.832.941"/>
                        </svg>
                        Telegram
                    </a>
                </div>
            </div>
        </div>

        <!-- Нижняя часть футера -->
        <div class="footer-bottom">
            <div class="legal-links">
                <a href="/privacy" class="legal-link">Политика конфиденциальности</a>
                <a href="/agreement" class="legal-link">Согласие на обработку данных</a>
            </div>
            <div class="copyright">
                © 2023 Smile Mafia Club. Все права защищены
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('javascript/courusel.js') }}"></script>
<script>
    function toggleMenu() {
        const navMenu = document.getElementById('navMenu');
        navMenu.classList.toggle('active');
        document.querySelector('.burger-menu').classList.toggle('active');
    }

    // Закрытие меню при клике вне области
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.burger-menu') && !e.target.closest('#navMenu')) {
            document.getElementById('navMenu').classList.remove('active');
            document.querySelector('.burger-menu').classList.remove('active');
        }
    });
</script>
</body>
</html>
