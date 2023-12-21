(function () {
    const popup = document.querySelector(".popup");
    if (!popup) return;

    const popupBtnOpens = document.querySelectorAll(".open__popup");
    const formTitleInput = popup.querySelector('[name="formTitle"]');
    const descForm = popup.querySelector(".popup__desc");

    const popupWrap = popup.querySelector(".popup__wrap");
    const popupSuccess = popup.querySelector(".popup__success");

    popupBtnOpens.forEach((el) => {
        el.addEventListener("click", function () {
            const title = el.nextElementSibling;
            descForm.style.display = "none";

            if (formTitleInput && title) {
                formTitleInput.value = title.innerHTML;
                descForm.innerHTML = title.innerHTML;
                descForm.style.display = "block";
            }

            openPopup();
        });
    });

    parent.addEventListener("click", function (e) {
        let target = e.target;

        if (target.classList.contains("popup__overlay") || target.classList.contains("popup__close")) {
            closePopup();
        }
    });

    function openPopup() {
        if (popupWrap.classList.contains("hide")) {
            popupWrap.classList.remove("hide");
        }

        if (popupSuccess.classList.contains("show")) {
            popupSuccess.classList.remove("show");
        }

        if (!popup.classList.contains("is_active")) {
            popup.classList.add("is_active");
        }
    }

    function closePopup() {
        if (popup.classList.contains("is_active")) {
            popup.classList.remove("is_active");
        }

        if (popupSuccess.classList.contains("show")) {
            popupSuccess.classList.remove("show");
        }

        if (popupWrap.classList.contains("hide")) {
            popupWrap.classList.remove("hide");
        }
    }
})();
