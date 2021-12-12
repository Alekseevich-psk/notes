const slidersWrapper = document.querySelectorAll('.sliders-wrapper');

if(slidersWrapper.length) {
    slidersWrapper.forEach(n => {
        let slider = n.querySelector('.slider__container');
        new Swiper(slider, {
            preloadImages: false,
            lazy: {
                loadPrevNext: false,
            },
            spaceBetween: 30,
            navigation: {
                nextEl: n.querySelector('.slider__arrow--next'),
                prevEl: n.querySelector('.slider__arrow--prev'),
            },
            pagination: {
                el: n.querySelector('.swiper-pagination'),
                type: 'bullets',
            },
            breakpoints: {
                320: {
                    spaceBetween: 15,
                    slidesPerView: 1,
                },
                440: {
                    spaceBetween: 15,
                    slidesPerView: 2,
                },
                728: {
                    spaceBetween: 30,
                    slidesPerView: 3,
                },
                960: {
                    spaceBetween: 30,
                    slidesPerView: 4,
                }
            }
        });
    });
}