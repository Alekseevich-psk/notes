(function () {
    const elems = document.querySelectorAll("elems");

    if (elems.length <= 0) return;

    elems.forEach(function (elem, i) {
        let text = elem.innerHTML.trim();
        let limit = 200;
        if (text.length <= limit) return text;
        text = text.slice(0, limit);
        elem.innerHTML = text.trim() + "...";
    });
})();
