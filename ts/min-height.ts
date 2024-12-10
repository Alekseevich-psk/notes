(function () {
    const wrappers: NodeList = document.querySelectorAll("[data-min-height]");
    if (wrappers.length === 0) return;

    const mobileScreen = 768;

    function getElementHeight(wrappers: NodeList) {
        wrappers.forEach((element: HTMLElement) => {
            const dataMinHeight = element.getAttribute("data-min-height");

            if (dataMinHeight && dataMinHeight !== "") {
                const classForElemMinHeight: string[] = dataMinHeight.replace(/\s/g, "").split(",");

                if (classForElemMinHeight && classForElemMinHeight.length > 0) {
                    classForElemMinHeight.forEach((cl: string) => {
                        const elementsHeight: number[] = [];
                        const innerElements = element.querySelectorAll(`.${cl}`) as NodeList;

                        innerElements.forEach((innerElem: HTMLElement) => {
                            const el = innerElem as HTMLElement;
                            el.style.minHeight = "initial";
                        });

                        if (innerElements.length > 0) {
                            innerElements.forEach((innerElem: HTMLElement) => {
                                elementsHeight.push(innerElem.offsetHeight);
                            });
                        }

                        const maxHeight = Math.max(...elementsHeight);
                        const windowSize = window.innerWidth;

                        innerElements.forEach((innerElem) => {
                            const el = innerElem as HTMLElement;

                            if (windowSize >= mobileScreen) {
                                el.style.minHeight = maxHeight + "px";
                            } else {
                                el.style.minHeight = "initial";
                            }
                        });
                    });
                }
            }
        });
    }

    window.addEventListener("load", () => {
        getElementHeight(wrappers);
    });

    window.addEventListener("resize", () => {
        getElementHeight(wrappers);
    });
})();
