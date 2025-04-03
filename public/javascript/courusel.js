document.addEventListener("DOMContentLoaded", function () {
    const carousel = {
        elements: {
            inner: document.querySelector(".carousel-inner"),
            prevBtn: document.querySelector(".carousel-prev"),
            nextBtn: document.querySelector(".carousel-next"),
            items: document.querySelectorAll(".carousel-item")
        },
        state: {
            index: 0,
            isAnimating: false,
            step: 2,
            itemWidth: 0
        },

        init() {
            if(this.elements.items.length === 0) return;

            this.calculateDimensions();
            this.setupEventListeners();
            this.addTouchSupport();
            window.addEventListener('resize', this.handleResize.bind(this));
        },

        calculateDimensions() {
            const style = getComputedStyle(this.elements.items[0]);
            this.state.itemWidth = this.elements.items[0].offsetWidth +
                parseInt(style.marginLeft) +
                parseInt(style.marginRight);

            // Адаптивный step
            this.state.step = window.innerWidth < 768 ? 1 : 2;
        },

        setupEventListeners() {
            this.elements.nextBtn.addEventListener('click', () => this.nextSlide());
            this.elements.prevBtn.addEventListener('click', () => this.prevSlide());
        },

        addTouchSupport() {
            let touchStartX = 0;

            this.elements.inner.addEventListener('touchstart', e => {
                touchStartX = e.touches[0].clientX;
            }, { passive: true });

            this.elements.inner.addEventListener('touchend', e => {
                const touchEndX = e.changedTouches[0].clientX;
                const diff = touchStartX - touchEndX;

                if(Math.abs(diff) > 50) {
                    diff > 0 ? this.nextSlide() : this.prevSlide();
                }
            });
        },

        nextSlide() {
            if(this.state.isAnimating) return;

            const maxIndex = Math.max(
                this.elements.items.length - this.state.step,
                0
            );

            if(this.state.index >= maxIndex) {
                this.state.index = 0;
            } else {
                this.state.index += this.state.step;
            }

            this.animateTransition();
        },

        prevSlide() {
            if(this.state.isAnimating) return;

            if(this.state.index <= 0) {
                this.state.index = Math.max(
                    this.elements.items.length - this.state.step,
                    0
                );
            } else {
                this.state.index -= this.state.step;
            }

            this.animateTransition();
        },

        animateTransition() {
            this.state.isAnimating = true;
            this.elements.inner.style.transition = 'transform 0.6s cubic-bezier(0.23, 1, 0.32, 1)';
            this.elements.inner.style.transform = `translateX(${-this.state.index * this.state.itemWidth}px)`;

            setTimeout(() => {
                this.state.isAnimating = false;
                this.elements.inner.style.transition = '';
            }, 600);
        },

        handleResize() {
            this.calculateDimensions();
            this.elements.inner.style.transform = `translateX(${-this.state.index * this.state.itemWidth}px)`;
        }
    };

    carousel.init();
});

document.querySelectorAll('.service-card, .about-card').forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        card.style.setProperty('--x', `${x}px`);
        card.style.setProperty('--y', `${y}px`);
    });

    // Опционально: Сброс при уходе курсора
    card.addEventListener('mouseleave', () => {
        card.style.removeProperty('--x');
        card.style.removeProperty('--y');
    });
});
