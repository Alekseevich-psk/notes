document.addEventListener("DOMContentLoaded", function () {
    const preloader = document.querySelector(".preloader") as HTMLElement | null;
    if (!preloader) return;

    setTimeout(() => {
        preloader.classList.add("hide");
    }, 1300);
});