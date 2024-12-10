import IMask from "imask";

(function () {
    const inputs = document.querySelectorAll('input[name="phone"]') as NodeList;
    if (inputs.length <= 0) return;

    inputs.forEach((element: HTMLElement) => {
        if (element) {

            element.addEventListener("input", (e) => {
                const target = e.target as HTMLInputElement;

                if (Number(target.value) === 8) {
                    target.value = "";
                } else {
                    IMask(element, {
                        mask: "+7 (000) 000-00-00",
                    });
                }
            });
        }
    });
})();

(function () {
    const inputs = document.querySelectorAll('input[name="email"]') as NodeList;
    if (inputs.length <= 0) return;

    inputs.forEach((element: HTMLElement) => {
        if (element) {
            let el = IMask(element, {
                mask: function (value : string) {
                    if (/^[a-z0-9_\.-]+$/.test(value)) return true;
                    if (/^[a-z0-9_\.-]+@$/.test(value)) return true;
                    if (/^[a-z0-9_\.-]+@[a-z0-9-]+$/.test(value)) return true;
                    if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.$/.test(value)) return true;
                    if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}$/.test(value)) return true;
                    if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.$/.test(value)) return true;
                    if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.[a-z]{1,4}$/.test(value)) return true;
                    return false;
                },
                lazy: false,
            });
        }
    });
})();