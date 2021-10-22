function trackScroll(el,class) {
    let scrolled = window.pageYOffset;
    let coords = 120;

    if (scrolled > coords) {
        el.classList.add(class);
    }

    if (scrolled < coords) {
        el.classList.remove(class);
    }
}
