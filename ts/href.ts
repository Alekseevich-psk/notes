(function () {
    const links = document.querySelectorAll('a[href*="#"]');
    if (links.length === 0) return;

    let marginTop = window.innerWidth <= 768 ? 0 : 100;

    const updateMarginTop = () => {
        marginTop = window.innerWidth <= 768 ? 0 : 100;
    };

    window.addEventListener("resize", updateMarginTop);

    links.forEach((link) => {
        link.addEventListener("click", (e) => {
            const blockID = link.getAttribute("href")?.substring(1);
            if (blockID) {
                const elem = document.getElementById(blockID);
                if (elem) {
                    e.preventDefault();
                    window.scrollBy({
                        top: elem.getBoundingClientRect().top - marginTop,
                        left: 0,
                        behavior: "smooth",
                    });
                }
            }
        });
    });
})();
