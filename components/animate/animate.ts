(function () {
    const elements = document.querySelectorAll("[data-anim-scroll]") as NodeList | null;

    interface Options {
        rootMargin: string;
        threshold: number;
    }

    const options: Options = {
        rootMargin: "100px",
        threshold: 0.5,
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const target = entry.target as HTMLElement;
                const animName = target.getAttribute("data-anim-name");
                const animDelay = target.getAttribute("data-anim-delay");
                const animDuration = target.getAttribute("data-anim-duration");

                target.classList.add("scroll-anim");

                if (animName !== "") {
                    target.style.animationName = animName;
                }

                if (animDuration !== null && animDuration !== "") {
                    target.style.animationDuration = animDuration;
                } else {
                    target.style.animationDuration = "1.5s";
                }

                if (animDelay !== "") {
                    target.style.animationDelay = animDelay + "ms";

                    setTimeout(() => {
                        target.style.opacity = "1";
                    }, Number(animDelay));
                } else {
                    target.style.opacity = "1";
                }
            }
        });
    }, options);

    if(elements !== null) {
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(() => {
                elements.forEach((elem) => {
                    const el = elem as HTMLElement;
                    observer.observe(el);
                });
            }, 1000);
        });
    }
})();
