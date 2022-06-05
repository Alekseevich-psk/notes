function heightElem(el) {
    return Math.max.apply(null, [el.clientHeight, el.offsetHeight, el.scrollHeight]);
}