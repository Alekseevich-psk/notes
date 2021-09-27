const availableScreenWidth = window.screen.availWidth
const availableScreenHeight = window.screen.availHeight


window.addEventListener('resize', function(event) {
    console.log(availableScreenWidth);
    console.log(availableScreenHeight);

    console.log(document.documentElement.clientWidth);
    console.log(document.documentElement.clientHeight);
}, true);
