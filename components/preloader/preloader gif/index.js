window.onload = function () {
    document.body.classList.add('loaded_hiding');
    window.setTimeout(function () {
        document.body.classList.add('loaded');
        document.body.classList.remove('loaded_hiding');
    }, 500);
}


// $(window).on('load', function() {
//     $('.preloader').fadeOut().end().delay(400).fadeOut('slow');
// });