const elems = document.querySelectorAll('elems');

if(elems) {
    elems.forEach(function(elem, i) {
        let text = elem.innerHTML.trim();
        let limit = 200;
        if( text.length <= limit) return text;
        text = text.slice(0, limit);
        elem.innerHTML = text.trim() + "...";
    })
}
