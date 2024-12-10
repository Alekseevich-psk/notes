(function () {
    const docRadios = document.querySelectorAll(".doc-radio") as NodeListOf<HTMLElement>;
    if (docRadios.length === 0) return;

    docRadios.forEach((radio: HTMLElement) => {
        const list = radio.querySelector(".doc-radio__list") as HTMLElement | null;
        const input = radio.querySelector(".doc-radio__fake-input") as HTMLElement | null;
        const items = radio.querySelectorAll(".doc-radio__item") as NodeListOf<HTMLElement>;

        items.forEach((item: HTMLElement) => {
            item.addEventListener("click", () => {
                items.forEach((item: HTMLElement) => {
                    if (item.classList.contains("active")) item.classList.remove("active");
                });

                item.classList.add("active");
                input.innerHTML = item.querySelector("label").innerHTML;
                list.classList.remove("active");
            });
        });

        if (input !== null) {
            input.addEventListener("click", () => {
                list.classList.toggle("active");
            });
        } else {
            console.error("input is null");
        }

        window.addEventListener("click", (e) => {
            const target = e.target as HTMLElement;

            if (!target.closest(".doc-radio")) {
                if (list.classList.contains("active")) list.classList.remove("active");
            }
        });
    });
})();
