let bg = document.querySelectorAll('.main__abs-img');

for (let i = 1; i < bg.length; i++){
    window.addEventListener('mousemove', function(e) {
        addMoveElem (e, bg[i]);
    });
}

function addMoveElem (e, elem) {
    let x = e.clientX / window.innerWidth;
    let y = e.clientY / window.innerHeight;
    elem.style.transform = 'translate(-' + x * 50 + 'px, -' + y * 50 + 'px)';
}
