(function () {
    const header = document.querySelector(".header") as HTMLElement | null;
    if (!header) return;

    const buttonMenu = header.querySelector(".header__menu-button") as HTMLElement | null;
    const menu = header.querySelector(".menu") as HTMLElement | null;
    const nextEl = header.nextElementSibling as HTMLElement | null;
    const items = header.querySelectorAll(".menu__link") as NodeList | null;

    const heightHeader = heightElem(header);

    function addClassForHeaderScroll() {
        if (header === null) return;

        if (getBodyScrollTop() > heightHeader) {
            header.classList.add("scroll");
        } else {
            header.classList.remove("scroll");
        }
    }

    function getBodyScrollTop() {
        return (
            self.scrollY ||
            (document.documentElement && document.documentElement.scrollTop) ||
            (document.body && document.body.scrollTop)
        );
    }

    function heightElem(el: HTMLElement) {
        return Math.max.apply(null, [el.clientHeight, el.offsetHeight, el.scrollHeight]);
    }

    items.forEach((element) => {
        const elem = element as HTMLElement;

        elem.addEventListener("click", () => {
            if (header !== null && header.classList.contains("open-menu")) {
                header.classList.remove("open-menu");
            }

            if (menu !== null && menu.classList.contains("active")) {
                menu.classList.remove("active");
            }
        });
    });

    if (buttonMenu !== null && menu !== null) {
        buttonMenu.addEventListener("click", () => {
            header.classList.toggle("open-menu");
            menu.classList.toggle("active");
        });
    }

    if (nextEl != null && !nextEl.classList.contains("main")) {
        nextEl.style.marginTop = header.offsetHeight + "px";
    }

    addClassForHeaderScroll();

    window.addEventListener("scroll", function () {
        addClassForHeaderScroll();
    });
})();
