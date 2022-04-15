(function () {
    const parent = document.querySelector(".popup");
    if (!parent) return;

    const popupBtnOpens = document.querySelectorAll(".open__popup");

    popupBtnOpens.forEach((el) => {
        el.addEventListener("click", function () {
            parent.classList.add("is_active");
        });
    });

    parent.addEventListener("click", function (e) {
        let target = e.target;
        console.log(target);
        if (target.classList.contains("popup__overlay") || target.classList.contains("popup__close")) {
            parent.classList.remove("is_active");
        }
    });
    
})();