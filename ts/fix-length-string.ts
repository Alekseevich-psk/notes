(function () {
    const elements = document.querySelectorAll("[data-str-length]") as NodeList;
    if (elements.length === 0) return;

    elements.forEach((element: HTMLElement) => {
        const newStrLength = element.getAttribute("data-str-length");
        const str = element.innerHTML as string;

        if (newStrLength && str.length > Number(newStrLength)) {
            element.innerHTML = str.slice(0, Number(newStrLength)) + "...";
        }
    });
})();
