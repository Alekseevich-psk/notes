(function () {
    const animElements = document.querySelectorAll("[data-anim-fade]") as NodeList;
    if (animElements.length === 0) return;

    function fadeOnVisible(element: HTMLElement) {
        const observer = new IntersectionObserver(
            (entries) => {
                if (entries[0].isIntersecting) {
                    element.style.opacity = "1";
                    element.classList.add("fade");
                }
            },
            { root: null, threshold: 0.5 }
        );

        observer.observe(element);
    }

    animElements.forEach((element: HTMLElement) => {
        fadeOnVisible(element);
    });
})();
