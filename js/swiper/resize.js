const newsContainerSlider = document.querySelector('.news__container');
let newsSlider;

const sliderInit = () => {

    newsSlider = new Swiper(newsContainerSlider, {
        navigation: {
            nextEl: ".news__arrow--next",
            prevEl: ".news__arrow--prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 3,
                spaceBetween: 30,
                direction: 'vertical',
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
                direction: 'horizontal',
            },
            980: {
                slidesPerView: 3,
                spaceBetween: 30,
            }
        }
    })
}

function resizeHandlerSlider() {

    if (window.screen.availWidth <= 768) {
        if(newsSlider) {
            newsSlider.destroy();
        }
    }

    sliderInit();

}

window.addEventListener('resize', resizeHandlerSlider);
resizeHandlerSlider();