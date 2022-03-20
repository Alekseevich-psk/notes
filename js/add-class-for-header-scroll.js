const header = document.querySelector(".header");
const classForHeaderScroll = "is_active";
const marginBottomFromElement = 80;

if (header) {
    const heightElem = getMaxOfArray(header);
    addClassForElement(header);

    window.onscroll = () => {
        addClassForElement(header);
    };

    function addClassForElement(el) {
        scrollHeight() > heightElem ? el.classList.add(classForHeaderScroll) : el.classList.remove(classForHeaderScroll);
    }

    function scrollHeight() {
        return Math.max.apply(null, [window.pageYOffset, document.documentElement.scrollTop]);
    }

    function getMaxOfArray(el) {
        return Math.max.apply(null, [el.clientHeight, el.offsetHeight, el.scrollHeight]) + marginBottomFromElement;
    }
}
