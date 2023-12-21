(function () {
    const sections = document.querySelectorAll("section");
    if (sections.length <= 0) return;

    const links = document.querySelectorAll('.menu a[href*="#"]');
    const linksHeader = document.querySelectorAll('.header .menu a[href*="#"]');
    const activeClass = "active";

    let marginScrollTop = 120;
    let activeItem = null;

    const options = {
        threshold: 0.8,
    };

    const getLinkValue = (link) => {
        const linkArray = link.href.split("#");

        return {
            elem: link,
            value: linkArray[linkArray.length - 1],
        };
    };

    const offActiveItem = (index, links) => {
        const elem = links[index].parentElement;

        if (elem.classList.contains(activeClass)) {
            elem.classList.remove(activeClass);
        }
    };

    const callback = function (entries, observer) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const target = entry.target.id;

                for (let i = 0; i < linksHeader.length; i++) {
                    const link = getLinkValue(linksHeader[i]);

                    if (target === link.value) {
                        if (activeItem !== null) {
                            offActiveItem(activeItem, linksHeader);
                        }

                        link.elem.parentElement.classList.add(activeClass);
                        return (activeItem = i);
                    } else {
                        offActiveItem(i, linksHeader);
                    }
                }
            }
        });
    };

    const onObserver = (element) => {
        new IntersectionObserver(callback, options).observe(element);
    };

    sections.forEach((section) => {
        onObserver(section);
    });

    links.forEach((link) => {
        link.addEventListener("click", (event) => {
            const objLink = getLinkValue(link);
            const section = document.querySelector("#" + objLink.value);

            for (let i = 0; i < links.length; i++) {
                offActiveItem(i, links);
            }

            if (section) {
                event.preventDefault();
                const toScrollCoords = Math.ceil(section.getBoundingClientRect().top + window.pageYOffset) - marginScrollTop;

                window.scrollTo({
                    top: toScrollCoords,
                    behavior: "smooth",
                });
            }
        });
    });

    window.addEventListener("resize", (event) => {
        if (window.innerWidth <= 960) {
            marginScrollTop = 60;
        }
    });
})();
