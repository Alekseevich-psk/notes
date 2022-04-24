(function() {

    const d = document.querySelector(".document");
    if (!d) return;

    function wrap(elem, className = 'wrapper') {
        const wrapper = document.createElement('div');
        wrapper.classList = className;
        wrapper.appendChild(elem.cloneNode(true));
        elem.insertAdjacentHTML('beforeBegin', wrapper.outerHTML);
        elem.remove();
    }

    d.querySelectorAll('table')
        .forEach(el => wrap(el, 'table__wrapper'));
    
}());
