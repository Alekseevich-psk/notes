(() => {
    const selects = document.querySelectorAll(".c-select") as NodeList;
    if (selects.length === 0) return;

    selects.forEach((select: HTMLElement) => {
        const wrapper = select.querySelector(".c-select__wrapper") as HTMLElement | null;
        const fakeInput = select.querySelector(".c-select__fake-input") as HTMLElement | null;
        const formInput = select.querySelector(".c-select__form-input") as HTMLInputElement | null;
        const items = select.querySelectorAll(".c-select__item") as NodeList;

        const closeAllSelects = () => {
            selects.forEach((select: HTMLElement) => {
                const wrapper = select.querySelector(".c-select__wrapper") as HTMLElement | null;

                if (wrapper !== null) {
                    if (wrapper.classList.contains("active")) wrapper.classList.remove("active");
                }
            });
        };

        items.forEach((item: HTMLElement) => {
            item.addEventListener("click", () => {
                fakeInput.innerHTML = item.innerHTML;
                formInput.value = item.innerHTML;
                wrapper.classList.remove("active");
            });
        });

        fakeInput.addEventListener("click", () => {
            closeAllSelects();
            wrapper.classList.toggle("active");
        });

        window.addEventListener("click", (e) => {
            const target = e.target as HTMLElement;

            if (!target.closest(".c-select")) {
                closeAllSelects();
            }
        });
    });
})();
